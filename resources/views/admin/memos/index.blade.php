<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Memorandums</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @can('admin.memos.create')
            <a class="btn btn-blue text-sm" href="{{route('admin.memos.create')}}">Nuevo</a>
        @endcan
    </div>

    {{-- Conditional rendering of the memos table or messages --}}
    @if ($memos->isNotEmpty())
        {{-- If there are memos to display --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            N° Control
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Memorandum
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dirigido
                        </th>
                        <th scope="col" class="px-6 py-3" width="20px">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($memos as $memo)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$memo->nro_control}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$memo->title}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$memo->category->name}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($memo->addressed_to)
                                    {{$memo->addressed_to}}</br>
                                    @foreach ($memo->departments as $item)
                                        @if ($item->manager && $item->manager->staff)
                                            {{$item->manager->staff->name}}</br>
                                        @else
                                            N/A</br>
                                        @endif
                                        {{$item->name}}</br>
                                    @endforeach
                                @else
                                    @foreach ($memo->departments as $item)
                                        @if ($item->manager && $item->manager->staff)
                                            {{$item->manager->staff->name}}</br>
                                        @else
                                            N/A</br>
                                        @endif
                                        {{$item->name}}</br>
                                    @endforeach
                                @endif
                            </th>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">

                                    @can('admin.memos.show')
                                        <flux:button href="{{route('admin.memos.show',$memo)}}" icon="eye" class="btn-outline-gray text-xs" title="Ver Información"></flux:button>
                                    @endcan

                                    @can('admin.memos.print')
                                        <flux:button href="{{route('admin.memos.print',$memo)}}" icon="printer" class="btn-outline-green text-xs" title="Imprimir" target="_blank"></flux:button>
                                    @endcan

                                    @can('admin.memos.edit')
                                        <flux:button href="{{route('admin.memos.edit',$memo)}}" icon="pencil" class="btn-outline-yellow text-xs" title="Editar Información"></flux:button>
                                    @endcan

                                    @can('admin.memos.destroy')
                                        <form class="delete-form" action="{{route('admin.memos.destroy', $memo)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button type="submit" icon="trash" class="btn-outline-red text-xs" title="Eliminar Información"></flux:button>
                                        </form>
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{$memos->links()}}
        </div>
    @else
        {{-- No memos to display, show messages based on role and department status --}}
        @if ($userRoleName === 'Admin')
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                <p class="font-bold">Sin Memorándums Registrados</p>
                <p>No se encontraron memorándums en el sistema.</p>
            </div>
        @elseif (($userRoleName === 'Coord' || $userRoleName === 'Normal'))
            @if (!$userHasDepartment)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">Información Incompleta</p>
                    <p>Tu usuario no está asociado a ningún departamento. Por favor, contacta al administrador para poder visualizar los memorándums.</p>
                </div>
            @else
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                    <p class="font-bold">Sin Memorándums en tu Departamento</p>
                    <p>No hay memorándums registrados para tu departamento.</p>
                </div>
            @endif
        @else
            {{-- For any other role or no role assigned --}}
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Acceso Restringido</p>
                <p>No tienes los permisos necesarios para ver memorándums o tu rol no permite esta vista.</p>
            </div>
        @endif
    @endif

    @push('js')
        <script>
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estas Seguro?",
                        text: "¡Vas a Eliminar un Memorandum!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, Eliminar!",
                        cancelButtonText: "Cancelar"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>