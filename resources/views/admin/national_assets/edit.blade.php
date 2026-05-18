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
        <form action="{{route('admin.national_assets.update', $nationalAsset)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <flux:input label="Bien Nacional:" name="code" value="{{old('code', $nationalAsset->code)}}" placeholder="Escriba el bien nacional." />

            <flux:input label="Serial:" name="serial" value="{{old('serial', $nationalAsset->serial)}}" placeholder="Escriba el serial del bien nacional." />

            <p>Tipo de clasificacion actual: {{$nationalAsset->typeNA}}</p>

            <flux:select label='Tpo de Clasificación' id="type" name="typeNA" placeholder="Elija por favor...">
                <flux:select.option value="Mobiliario" :selected="(old('typeNA', $nationalAsset->typeNA) === 'Mobiliario')">Mobiliario</flux:select.option>
                <flux:select.option value="Oficina" :selected="(old('typeNA', $nationalAsset->typeNA) === 'Oficina')">Oficina</flux:select.option>
                <flux:select.option value="Tecnologico" :selected="(old('typeNA', $nationalAsset->typeNA) === 'Tecnologico')">Tecnologico</flux:select.option>
            </flux:select>

            <p>Clasificacion actual: {{$nationalAsset->classification->name.'->'.$nationalAsset->classification->brand.'->'.$nationalAsset->classification->model}}</p>

            <flux:select label='Clasificacion:' id="classification_id" name="classification_id" placeholder="Elija por favor...">
                @foreach ($classifications as $classification)
                    <flux:select.option
                        value="{{$classification->id}}"
                        data-type="{{$classification->type}}"
                        :selected="($classification->id == old('classification_id', $nationalAsset->classification_id))"
                    >
                        {{$classification->name.'->'.$classification->brand.'->'.$classification->model}}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:select label='Estatus:' name="status" placeholder="Elija por favor...">
                <flux:select.option value="Optimo" :selected="(old('status', $nationalAsset->status) == 'Optimo')">Optimo</flux:select.option>
                <flux:select.option value="Regular" :selected="(old('status', $nationalAsset->status) == 'Regular')">Regular</flux:select.option>
                <flux:select.option value="Deteriorado" :selected="(old('status', $nationalAsset->status) == 'Deteriorado')">Deteriorado</flux:select.option>
                <flux:select.option value="Averiado" :selected="(old('status', $nationalAsset->status) == 'Averiado')">Averiado</flux:select.option>
                <flux:select.option value="Chatarra" :selected="(old('status', $nationalAsset->status) == 'Chatarra')">Chatarra</flux:select.option>
                <flux:select.option value="No Operativo" :selected="(old('status', $nationalAsset->status) == 'No Operativo')">No Operativo</flux:select.option>
            </flux:select>

            <flux:textarea label="Descripcion:" name="description" placeholder="Describe el material y color del bien.">{{old('description', $nationalAsset->description)}}</flux:textarea>
            
            <flux:select label='Selecione la unidad a la que pertenece' name="department_id" placeholder="Elija por favor...">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}" :selected="$department->id == old('department_id', $nationalAsset->department_id)">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="Responsable por uso:" name="responsible_for_use" value="{{old('responsible_for_use', $nationalAsset->responsible_for_use)}}" placeholder="Escriba quien se hara responsable del bien." />

            <flux:textarea label="Observaciones:" name="observations" placeholder="Observaciones.">{{old('observations', $nationalAsset->observations)}}</flux:textarea>

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button>
            </div>
        </form>
    </div>

    @push('js')
        <script>
           document.addEventListener('DOMContentLoaded', () => {
            const typeSelect = document.getElementById('type');
            const classificationSelect = document.getElementById('classification_id');

            // ¡CLAVE! Guardamos los valores que Blade (PHP) pudo haber pre-seleccionado.
            // Esto lo hacemos ANTES de que el script haga cualquier cambio.
            const initialTypeNA = typeSelect.value;
            const initialClassificationId = classificationSelect.value;

            // Función para filtrar las opciones de clasificación
            const filterClassifications = () => {
                const selectedType = typeSelect.value; // El tipo actualmente seleccionado (puede ser el inicial o uno cambiado por el usuario)
                const classificationOptions = classificationSelect.querySelectorAll('option');

                // Si no hay un tipo seleccionado, deshabilita y limpia el select de clasificación
                if (!selectedType) {
                    classificationSelect.value = ''; // Reiniciar selección a la opción vacía
                    classificationSelect.disabled = true; // Deshabilitar hasta que se elija un tipo
                } else {
                    classificationSelect.disabled = false; // Habilitar si ya hay un tipo seleccionado
                }

                classificationOptions.forEach(option => {
                    // Siempre mostramos la opción "Elija por favor..." (la que tiene value="")
                    if (option.value === "") {
                        option.classList.remove('classification-option-hidden');
                        return; // Saltar al siguiente option
                    }

                    const optionType = option.dataset.type; // Obtenemos el 'data-type' de la opción
                    if (selectedType === "" || optionType === selectedType) {
                        // Si el tipo seleccionado es vacío (placeholder) o coincide con el tipo de la opción, la mostramos
                        option.classList.remove('classification-option-hidden');
                    } else {
                        // Si no coincide, la ocultamos
                        option.classList.add('classification-option-hidden');
                        // Y si esta opción que estamos ocultando era la actualmente seleccionada, reiniciamos el select de clasificación
                        // Esto es importante cuando el usuario cambia el tipo y la clasificación anterior ya no es válida.
                        if (option.selected) {
                            classificationSelect.value = "";
                        }
                    }
                });

                // Después de filtrar, si la opción que estaba seleccionada (antes de este filtrado) ahora está oculta,
                // reiniciamos el select de clasificación para evitar selecciones inválidas.
                const currentSelectedOption = classificationSelect.options[classificationSelect.selectedIndex];
                if (currentSelectedOption && currentSelectedOption.classList.contains('classification-option-hidden')) {
                    classificationSelect.value = "";
                }
            };

            // --- CAMBIOS IMPORTANTES AQUÍ ---

            // No reseteamos typeSelect.value o classificationSelect.value a vacío si Blade ya los había pre-seleccionado.
            // Solo los establecemos a vacío si realmente están vacíos (null, undefined, o "") después de la carga inicial.

            if (initialTypeNA === null || initialTypeNA === undefined || initialTypeNA === "") {
                typeSelect.value = ""; // Si no hay un tipo inicial de Blade, seleccionamos el placeholder
            }
            // No necesitamos forzar la selección aquí para classificationSelect.value.
            // La lógica de re-aplicar la selección inicial se hará más abajo.

            // Ejecutar el filtrado inicial basado en el valor inicial de typeSelect (sea el de Blade o el placeholder)
            filterClassifications();

            // Después de que el filtro inicial se ejecute, re-intentamos aplicar la clasificación inicial.
            // Esto es crucial porque el filtro pudo haber ocultado la opción inicialmente seleccionada.
            if (initialTypeNA) { // Si había un tipo pre-seleccionado por Blade
                classificationSelect.disabled = false; // Nos aseguramos de que el select de clasificación esté habilitado

                if (initialClassificationId) { // Y si también había una clasificación pre-seleccionada por Blade
                    const initialClassificationOption = classificationSelect.querySelector(`option[value="${initialClassificationId}"]`);
                    // Solo re-aplicamos la clasificación inicial si existe y NO está oculta después del filtro.
                    if (initialClassificationOption && !initialClassificationOption.classList.contains('classification-option-hidden')) {
                        classificationSelect.value = initialClassificationId;
                    } else {
                        // Si la clasificación inicial no es válida para el tipo pre-seleccionado (o está oculta), la reseteamos.
                        classificationSelect.value = "";
                    }
                }
            } else {
                // Si no había un tipo inicial, asegúrate de que classification_id esté en blanco.
                classificationSelect.value = "";
            }


            // Añadir un "event listener" para cuando cambie la selección del 'type' por el usuario
            typeSelect.addEventListener('change', () => {
                filterClassifications();
                // Cuando el usuario CAMBIA el tipo, siempre reseteamos la clasificación para forzar una nueva selección válida.
                classificationSelect.value = "";
            });
        });
        </script>
    @endpush
</x-layouts.app>