<x-layouts.app>
    @push('css')
        <style>
            /* Estilo para ocultar opciones */
        .classification-option-hidden {
            display: none !important;
        }
        </style>
    @endpush
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.national_assets.index')">Bienes Nacionales</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.national_assets.store')}}" method="POST" class="space-y-4">
            @csrf
            
            <flux:input label="Bien Nacional:" name="code" value="{{old('code')}}" placeholder="Escriba el bien nacional." />

            <flux:input label="Serial:" name="serial" value="{{old('serial')}}" placeholder="Escriba el serial del bien nacional." />

            <flux:select label='Tpo de Clasificación' id="type" name="typeNA" placeholder="Elija por favor...">
                <flux:select.option value="Mobiliario" :selected="old('typeNA')">Mobiliario</flux:select.option>
                <flux:select.option value="Oficina" :selected="old('typeNA')">Oficina</flux:select.option>
                <flux:select.option value="Tecnologico" :selected="old('typeNA')">Tecnologico</flux:select.option>
            </flux:select>

            <flux:select label='Clasificacion:' id="classification_id" name="classification_id" placeholder="Elija por favor...">
                @foreach ($classifications as $classification)
                    <flux:select.option value="{{$classification->id}}" data-type="{{$classification->type}}">{{$classification->name.'->'.$classification->brand.'->'.$classification->model}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select label='Estatus:' name="status" placeholder="Elija por favor...">
                <flux:select.option value="Optimo" :selected="old('status')">Optimo</flux:select.option>
                <flux:select.option value="Regular" :selected="old('status')">Regular</flux:select.option>
                <flux:select.option value="Deteriorado" :selected="old('status')">Deteriorado</flux:select.option>
                <flux:select.option value="Averiado" :selected="old('status')">Averiado</flux:select.option>
                <flux:select.option value="Chatarra" :selected="old('status')">Chatarra</flux:select.option>
                <flux:select.option value="No Operativo" :selected="old('status')">No Operativo</flux:select.option>
            </flux:select>

            <flux:textarea label="Descripcion:" name="description" placeholder="Describe el material y color del bien.">{{old('description')}}</flux:textarea>
            
            <flux:select label='Selecione la unidad a la que pertenece' name="department_id" placeholder="Elija por favor...">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}" :selected="$department->id == old('department_id')">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="Responsable por uso:" name="responsible_for_use" value="{{old('responsible_for_use')}}" placeholder="Escriba quien se hara responsable del bien." />

            <flux:textarea label="Observaciones:" name="observations" placeholder="Observaciones.">{{old('observations')}}</flux:textarea>

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
            const typeSelect = document.getElementById('type');
            const classificationSelect = document.getElementById('classification_id');

            // Función para filtrar las opciones de clasificación
            const filterClassifications = () => {
                const selectedType = typeSelect.value;
                const classificationOptions = classificationSelect.querySelectorAll('option');

                // Limpiar la selección actual y deshabilitar si no se selecciona ningún tipo
                if (!selectedType) {
                    classificationSelect.value = ''; // Reiniciar selección
                    classificationSelect.disabled = true; // Deshabilitar hasta que se elija un tipo
                } else {
                    classificationSelect.disabled = false; // Habilitar una vez que se elige un tipo
                }

                classificationOptions.forEach(option => {
                    // Siempre mostrar la opción "Elija por favor..."
                    if (option.value === "") {
                        option.classList.remove('classification-option-hidden');
                        return;
                    }

                    const optionType = option.dataset.type; // Obtener el atributo de datos personalizado
                    if (selectedType === "" || optionType === selectedType) {
                        option.classList.remove('classification-option-hidden');
                    } else {
                        option.classList.add('classification-option-hidden');
                        // Si la opción actualmente seleccionada está oculta, reiniciar el select de clasificación
                        if (option.selected) {
                            classificationSelect.value = "";
                        }
                    }
                });

                // Después de filtrar, si la selección actual ya no es visible, reiniciarla
                const currentSelectedOption = classificationSelect.options[classificationSelect.selectedIndex];
                if (currentSelectedOption && currentSelectedOption.classList.contains('classification-option-hidden')) {
                    classificationSelect.value = ""; // Deseleccionar si la opción actual está oculta
                }
            };

            // Establecer la selección inicial para "Elija por favor..."
            typeSelect.value = ""; // Asegura que "Elija por favor..." esté seleccionado inicialmente
            classificationSelect.value = ""; // Asegura que "Elija por favor..." esté seleccionado inicialmente

            // Ejecutar el filtrado inicial cuando la página se carga
            filterClassifications();

            // Añadir un "event listener" para cuando cambie la selección del 'type'
            typeSelect.addEventListener('change', () => {
                filterClassifications();
                // Reiniciar la selección de clasificación cuando el tipo cambia para evitar selecciones inválidas
                classificationSelect.value = "";
            });
        });

        </script>
    @endpush
</x-layouts.app>