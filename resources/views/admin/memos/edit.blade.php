<x-layouts.app>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.memos.index')">Memorandum</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="car">
        <form action="{{route('admin.memos.update', $memo)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <flux:input readonly variant="filled" label="Nro Control:" name="nro_control" value="{{$memo->nro_control}}" />

            <flux:input readonly variant="filled" label="Fecha de creación:" name="date_created" value="{{$memo->date_created->toDateString()}}" />
            
            <flux:select label='Categoria a la que pertenece el memo' name="category_id" placeholder="Elija por favor...">
                @foreach ($categories as $category)
                    <flux:select.option value="{{$category->id}}" :selected="$category->id == old('category_id', $memo->category_id)">{{$category->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="Titulo:" name="title" value="{{old('title', $memo->title)}}" placeholder="Escriba el titulo del memo." />

            <div>
                <p class="font-medium text-sm mb-1">Contenido</p>
                <div id="editor">{!!old('content',$memo->content)!!}</div>
                <textarea class="hidden" name="content" id="content">{!!old('content',$memo->content)!!}</textarea>
            </div>

            <div>
                <p class="font-medium text-sm mb-1">Dirigido a:</p>
            </div>

             @php
            $contador = 0;
            $departments_por_columna = ceil(count($departments)/3);

            echo '<div class="noticias">';

            echo '<label class="flex items-center space-x-2"><input type="checkbox" id="check-all" onchange="toggleAll(this.checked)"><span>Seleccionar todos</span></label>';

            foreach ($departments as $department) {
                $checked = in_array($department->id, old('departments',$memo->departments->pluck('id')->toArray())) ? ' checked="checked" ' :'';

                $contador++;
                
                if ($contador ===  $departments_por_columna ) {
                    echo '<div class="columna">';
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="departments[]" value="'.$department->id.'" class="item-checkbox"'.$checked.'><span>'.$department->name.'</span></label>';
                    echo '</div>';
                }
                else if ($contador ===  $departments_por_columna ) {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="departments[]" value="'.$department->id.'" class="item-checkbox"'.$checked.'><span>'.$department->name.'</span></label>';
                    echo '</div>';
                    echo '</div>';
                    
                    $contador = 0;
                }
                else {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="departments[]" value="'.$department->id.'" class="item-checkbox"'.$checked.'><span>'.$department->name.'</span></label>';
                    echo '</div>';
                }
            }

            echo '<label class="flex items-center space-x-2"><input type="checkbox" id="otros"><span>Otros</span></label>'; 
            
            echo '</div>';
            @endphp
                    <div class="form-group" id="input-otros" 
                            @if ($memo->addressed_to)
                                style="display: block;"
                            @else
                                style="display: none;"
                            @endif>
                        <flux:input label="Especifique:" name="addressed_to" value="{{old('addressed_to', $memo->addressed_to)}}" id="valor_otros" placeholder="Escriba a quien va dirigido el memo." />
                    </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            const checkboxOtros = document.getElementById('otros');
            const inputOtros = document.getElementById('input-otros');

            checkboxOtros.addEventListener('change', function() {
                if (this.checked) {
                    inputOtros.style.display = 'block';
                } else {
                    inputOtros.style.display = 'none';
                }
            });
        </script>
        <script>
            function toggleAll(checked) {
                let checkboxes = document.querySelectorAll('.item-checkbox');
                for (let i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = checked;
                }
                if (!checked) { // Si se desactiva el checkbox "Seleccionar todos"
                document.getElementById("check-all").checked = false;
                }
                if (document.getElementById('check-all').checked) {
                    // Si se selecciona el checkbox "Seleccionar todos"
                    document.getElementById("check-all").checked = true;
                }

            }

            document.addEventListener("click", (e) => {
                if (e.target.classList.contains("item-checkbox")) {
                if(!document.getElementById('check-all').checked) {
                    document.getElementById("check-all").checked = false;
                } else {
                    let checkboxes = document.querySelectorAll('.item-checkbox');
                    let allChecked = true;
                        for (let i = 0; i < checkboxes.length; i++) {
                        if (!checkboxes[i].checked) {
                            allChecked = false;
                            break;
                        }
                        }
                    if (!allChecked) {
                        document.getElementById("check-all").checked = false;
                    }
                }
                }
            });
        </script>
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            quill.on('text-change', function(){
                document.querySelector('#content').value = quill.root.innerHTML;
            });
        </script>
    @endpush
</x-layouts.app>