<x-layouts.app>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.projects.index')">Proyectos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item> {{-- Cambiado a "Editar" --}}
        </flux:breadcrumbs>
    </div>
    <div class="card">
        {{-- Formulario de edición de proyecto --}}
        <form action="{{route('admin.projects.update', $project)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') {{-- Directiva para indicar que es una solicitud PUT para la actualización --}}
            
            {{-- Campo de título --}}
            <flux:input label="Titulo" name="title" value="{{old('title', $project->title)}}" placeholder="Escriba el titulo del proyecto." />

            {{-- Campo de selección de departamento --}}
            <flux:select label='Departamento al que pertenece el proyecto' name="department_id" placeholder="Elija por favor...">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}" :selected="$department->id == old('department_id', $project->department_id)">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

            {{-- Campo de selección de categoría --}}
            <flux:select label='Categoria a la que pertenece el proyecto' name="category_id" placeholder="Elija por favor...">
                @foreach ($categories as $category)
                    <flux:select.option value="{{$category->id}}" :selected="$category->id == old('category_id', $project->category_id)">{{$category->name}}</flux:select.option>
                @endforeach
            </flux:select>

            {{-- Campo de fecha de inicio --}}
            <flux:input label="Fecha de Inicio:" type="date" max="2999-12-31" name='date_start' value="{{old('date_start', $project->date_start->toDateString())}}"/>
            
            {{-- Campo de fecha de culminación, condicional según si ya tiene una fecha --}}
            @if (!$project->date_finish)
                <flux:input label="Fecha de Culminación:" type="date" min="{{$project->date_start->toDateString()}}" max="2999-12-31" name='date_finish' value="{{old('date_finish')}}" />
            @else
                <flux:input label="Fecha de Culminación:" type="date" max="2999-12-31" name='date_finish' value="{{old('date_finish', $project->date_finish->toDateString())}}" />
            @endif

            {{-- Editor de contenido Quill --}}
            <div>
                <p class="font-medium text-sm mb-1">Contenido</p>
                <div id="editor">{!!old('content', $project->content)!!}</div>
                <textarea class="hidden" name="content" id="content">{!!old('content', $project->content)!!}</textarea>
            </div>

            {{-- Campo de selección de estatus --}}
            <flux:select label='Estatus' name="status" placeholder="Elija por favor...">
                <flux:select.option value="Iniciado" :selected="(old('status', $project->status) == 'Iniciado')">Iniciado</flux:select.option>
                <flux:select.option value="En Ejecución" :selected="(old('status', $project->status) == 'En Ejecución')">En Ejecución</flux:select.option>
                <flux:select.option value="Pendiente" :selected="(old('status', $project->status) == 'Pendiente')">Pendiente</flux:select.option>
                <flux:select.option value="Culminado" :selected="(old('status', $project->status) == 'Culminado')">Culminado</flux:select.option>
            </flux:select>

            <div>
                <p class="font-medium text-sm mb-1">Integrantes del proyecto:</p>
            </div>

            {{-- Lógica para los checkboxes del personal --}}
            @php
                // Obtener el personal previamente seleccionado de errores de validación (old)
                // o el personal actualmente asociado al proyecto (si no hay errores)
                $oldStaffs = old('staffs', $project->staffs->pluck('id')->toArray());
            @endphp

            {{-- Contenedor para los checkboxes de personal con diseño de cuadrícula responsivo --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="checkboxList">
                {{-- Checkbox "Seleccionar todos" que abarca todo el ancho --}}
                <div class="col-span-full">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" id="check-all" onchange="toggleAll(this.checked)">
                        <span>Seleccionar todos</span>
                    </label>
                </div>

                {{-- Iterar sobre el personal disponible y crear un checkbox para cada uno --}}
                @foreach ($staffs as $staff)
                    <div class="noticia">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="staffs[]" value="{{ $staff->id }}" class="item-checkbox"
                                {{ in_array($staff->id, $oldStaffs) ? 'checked' : '' }}>
                            <span>{{ $staff->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            {{-- Mostrar errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            {{-- Botón de envío del formulario --}}
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button> {{-- Texto del botón cambiado --}}
            </div>
        </form>
    </div>

    @push('js')

    <script>
        /**
         * Alterna el estado 'checked' de todos los checkboxes de personal.
         * @param {boolean} checked - Verdadero si el checkbox "Seleccionar todos" está marcado, falso en caso contrario.
         */
        function toggleAll(checked) {
            let checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const checkAllCheckbox = document.getElementById('check-all');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');

            /**
             * Actualiza el estado del checkbox "Seleccionar todos" basándose en el estado de los checkboxes individuales.
             */
            function updateCheckAllStatus() {
                // Verifica si todos los checkboxes individuales están marcados
                const allItemsChecked = Array.from(itemCheckboxes).every(checkbox => checkbox.checked);
                // Establece el estado del checkbox "Seleccionar todos"
                checkAllCheckbox.checked = allItemsChecked;
            }

            // Añadir un event listener a cada checkbox individual para actualizar el estado de "Seleccionar todos"
            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCheckAllStatus);
            });

            // Llamada inicial para establecer el estado correcto del checkbox "Seleccionar todos" al cargar la página
            updateCheckAllStatus();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <!-- Inicializar el editor Quill -->
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Al cargar la página, establecer el contenido inicial del editor Quill
        // con el contenido del proyecto o el contenido antiguo si hay errores de validación.
        const initialContent = document.querySelector('#content').value;
        quill.root.innerHTML = initialContent;

        quill.on('text-change', function(){
            document.querySelector('#content').value = quill.root.innerHTML;
        });
    </script>
    @endpush
</x-layouts.app>
