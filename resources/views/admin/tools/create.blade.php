<x-layouts.app>
    @push('css')
    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .modal.open {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 700px;
            max-height: 90vh; /* Limita la altura del modal */
            overflow-y: auto; /* Permite desplazamiento si el contenido es largo */
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }
        .modal.open .modal-content {
            transform: translateY(0);
        }
    </style>   
    @endpush
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.tools.index')">Herramientas y Consumibles</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.tools.store')}}" method="POST" class="space-y-4">
            @csrf

            <flux:input label="N° Memorandum:" name="memo" value="{{old('memo')}}" placeholder="Escriba el numero de memo de control." />

            <flux:select label='Selecione la unidad a la que pertenece' name="department_id" placeholder="Elija por favor...">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}" :selected="$department->id == old('department_id')">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="Fecha de recepcion:" type="date" max="2999-12-31" name='date_of_receipt' value="{{old('date_of_receipt')}}"/>

            <div>
                    <p class="font-medium text-sm mb-2 text-gray-700">Herramientas y Consumibles Seleccionados:</p>
                    <button type="button" id="openToolModalBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Seleccionar Herramientas
                    </button>

                    <!-- Container for selected tools - ADDED overflow-x-auto HERE -->
                <div id="selectedToolsContainer" class="mt-4 border border-gray-200 rounded-md p-4 bg-gray-50 overflow-x-auto">
                    <!-- Selected tools will be rendered here by JavaScript -->
                    <p id="noToolsSelectedMessage" class="text-gray-500 italic">No hay herramientas seleccionadas.</p>
                </div>
            @error('selected_tools')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    
            </div>

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>

<!-- The Modal Structure -->
    <div id="toolSelectionModal" class="modal">
        <div class="modal-content">
            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Seleccionar Herramientas y Consumibles</h3>
                <button type="button" id="closeModalBtn" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="py-4">
                <!-- Select All Checkbox -->
                <div class="mb-3">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" id="selectAllModalTools" class="form-checkbox text-blue-600 rounded">
                        <span class="text-gray-800 font-semibold">Seleccionar todos</span>
                    </label>
                </div>

                <!-- Checkbox List for Modal -->
                <div id="modalCheckboxList" class="space-y-2 max-h-80 overflow-y-auto pr-2">
                    <!-- Checkboxes will be dynamically inserted here by JavaScript -->
                </div>
            </div>

            <div class="flex justify-end pt-3 border-t border-gray-200">
                <button type="button" id="cancelModalBtn" class="mr-2 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cerrar
                </button>
                <button type="button" id="confirmSelectionBtn" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Confirmar Selección
                </button>
            </div>
        </div>
    </div>

    @push('js')
        <script>
        // Simulate the $ClassificationTools variable from Laravel
        const ClassificationTools = @json($ClassificationTools);

        // State for selected tools in the main form (persisted)
        let selectedToolsData = []; // Array of { id, name, brand, model, stock, statusTool, observations }

        // State for temporary selection in the modal
        let tempModalSelection = new Set(); // Stores IDs of tools selected in the modal

        document.addEventListener('DOMContentLoaded', function() {
            const openToolModalBtn = document.getElementById('openToolModalBtn');
            const toolSelectionModal = document.getElementById('toolSelectionModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelModalBtn = document.getElementById('cancelModalBtn');
            const confirmSelectionBtn = document.getElementById('confirmSelectionBtn');
            const modalCheckboxList = document.getElementById('modalCheckboxList');
            const selectAllModalTools = document.getElementById('selectAllModalTools');
            const selectedToolsContainer = document.getElementById('selectedToolsContainer');
            const noToolsSelectedMessage = document.getElementById('noToolsSelectedMessage');

            // --- Modal Functions ---
            function openModal() {
                // Populate modal checkboxes based on current selectedToolsData
                tempModalSelection = new Set(selectedToolsData.map(tool => tool.id));
                renderModalCheckboxes();
                toolSelectionModal.classList.add('open');
            }

            function closeModal() {
                toolSelectionModal.classList.remove('open');
            }

            function renderModalCheckboxes() {
                modalCheckboxList.innerHTML = ''; // Clear existing checkboxes
                ClassificationTools.forEach(tool => {
                    const div = document.createElement('div');
                    const label = document.createElement('label');
                    label.className = 'flex items-center space-x-2 cursor-pointer';

                    const input = document.createElement('input');
                    input.type = 'checkbox';
                    input.name = 'modal_tools[]'; // Use a different name for modal checkboxes
                    input.value = tool.id;
                    input.className = 'modal-item-checkbox form-checkbox text-blue-600 rounded';
                    input.checked = tempModalSelection.has(tool.id); // Set checked state based on temp selection

                    input.addEventListener('change', (event) => {
                        if (event.target.checked) {
                            tempModalSelection.add(tool.id);
                        } else {
                            tempModalSelection.delete(tool.id);
                        }
                        updateSelectAllModalCheckboxState();
                    });

                    const span = document.createElement('span');
                    span.className = 'text-gray-700';
                    span.textContent = `${tool.name} Marca: ${tool.brand} Modelo: ${tool.model}`;

                    label.appendChild(input);
                    label.appendChild(span);
                    div.appendChild(label);
                    modalCheckboxList.appendChild(div);
                });
                updateSelectAllModalCheckboxState(); // Update select all based on initial state
            }

            function updateSelectAllModalCheckboxState() {
                const modalItemCheckboxes = document.querySelectorAll('.modal-item-checkbox');
                if (modalItemCheckboxes.length === 0) {
                    selectAllModalTools.checked = false;
                    selectAllModalTools.indeterminate = false;
                    return;
                }
                const allChecked = Array.from(modalItemCheckboxes).every(item => item.checked);
                const anyChecked = Array.from(modalItemCheckboxes).some(item => item.checked);

                selectAllModalTools.checked = allChecked;
                selectAllModalTools.indeterminate = anyChecked && !allChecked;
            }

            // --- Main View Functions ---
            function renderSelectedTools() {
                selectedToolsContainer.innerHTML = ''; // Clear existing content

                if (selectedToolsData.length === 0) {
                    noToolsSelectedMessage.classList.remove('hidden');
                    selectedToolsContainer.appendChild(noToolsSelectedMessage);
                    return;
                } else {
                    noToolsSelectedMessage.classList.add('hidden');
                }

                const table = document.createElement('table');
                table.className = 'min-w-full divide-y divide-gray-200';
                table.innerHTML = `
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-md">Herramienta</th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-md">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    </tbody>
                `;
                const tbody = table.querySelector('tbody');

                selectedToolsData.forEach(tool => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-gray-50';
                    row.innerHTML = `
                        <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                            ${tool.name} <span class="text-gray-500 text-xs">(Marca: ${tool.brand}, Modelo: ${tool.model})</span>
                            <input type="hidden" name="selected_tools[${tool.id}][id]" value="${tool.id}">
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <input type="number" name="selected_tools[${tool.id}][stock]" value="${tool.stock || ''}" placeholder="Cantidad" class="form-input w-24" min="0">
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <select name="selected_tools[${tool.id}][statusTool]" class="form-select w-32">
                                <option value="">Seleccionar</option>
                                <option value="Optimo" ${tool.statusTool === 'Optimo' ? 'selected' : ''}>Optimo</option>
                                <option value="Regular" ${tool.statusTool === 'Regular' ? 'selected' : ''}>Regular</option>
                                <option value="Deteriorado" ${tool.statusTool === 'Deteriorado' ? 'selected' : ''}>Deteriorado</option>
                                <option value="Averiado" ${tool.statusTool === 'Averiado' ? 'selected' : ''}>Averiado</option>
                                <option value="Chatarra" ${tool.statusTool === 'Chatarra' ? 'selected' : ''}>Chatarra</option>
                                <option value="No Operativo" ${tool.statusTool === 'No Operativo' ? 'selected' : ''}>No Operativo</option>
                            </select>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <textarea name="selected_tools[${tool.id}][observations]" placeholder="Observaciones" class="form-textarea h-10 resize-none">${tool.observations || ''}</textarea>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button type="button" data-tool-id="${tool.id}" class="remove-tool-btn text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
                selectedToolsContainer.appendChild(table);

                // Add event listeners for remove buttons
                document.querySelectorAll('.remove-tool-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const toolIdToRemove = parseInt(this.dataset.toolId);
                        selectedToolsData = selectedToolsData.filter(tool => tool.id !== toolIdToRemove);
                        renderSelectedTools(); // Re-render the list
                    });
                });
            }

            // --- Event Listeners ---
            openToolModalBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            cancelModalBtn.addEventListener('click', closeModal);

            selectAllModalTools.addEventListener('change', function() {
                document.querySelectorAll('.modal-item-checkbox').forEach(checkbox => {
                    checkbox.checked = this.checked;
                    const toolId = parseInt(checkbox.value);
                    if (this.checked) {
                        tempModalSelection.add(toolId);
                    } else {
                        tempModalSelection.delete(toolId);
                    }
                });
            });

            confirmSelectionBtn.addEventListener('click', function() {
                const newSelectedToolsData = [];
                tempModalSelection.forEach(id => {
                    const tool = ClassificationTools.find(t => t.id === id);
                    if (tool) {
                        // Check if the tool was already selected and preserve its stock/status/observations
                        const existingTool = selectedToolsData.find(st => st.id === id);
                        newSelectedToolsData.push({
                            ...tool,
                            stock: existingTool ? existingTool.stock : '',
                            statusTool: existingTool ? existingTool.statusTool : '',
                            observations: existingTool ? existingTool.observations : ''
                        });
                    }
                });
                selectedToolsData = newSelectedToolsData;
                renderSelectedTools();
                closeModal();
            });
            renderSelectedTools();
        });
    </script>
    @endpush
</x-layouts.app>