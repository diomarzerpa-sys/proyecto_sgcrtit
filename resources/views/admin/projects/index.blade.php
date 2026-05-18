<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Proyectos</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @can('admin.projects.create')
            <a class="btn btn-blue text-sm" href="{{route('admin.projects.create')}}">Nuevo</a>
        @endcan
    </div>

    {{-- Renderizado condicional de la tabla de proyectos o mensajes --}}
    @if ($projects->isNotEmpty())
        {{-- Si hay proyectos para mostrar --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Proyecto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoría
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estatus
                        </th>
                        <th scope="col" class="px-6 py-3" width="20px">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$project->id}}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$project->title}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $project->category->name ?? 'N/A' }} {{-- Usamos ?? 'N/A' por si la categoría es null --}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$project->status}}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">

                                    @can('admin.projects.show')
                                        <flux:button href="{{route('admin.projects.show',$project)}}" icon="eye" class="btn-outline-gray text-xs" title="Ver Información"></flux:button>
                                    @endcan

                                    @can('admin.projects.edit')
                                        <flux:button href="{{route('admin.projects.edit',$project)}}" icon="pencil" class="btn-outline-yellow text-xs" title="Editar Información"></flux:button>
                                    @endcan

                                    @can('admin.projects.destroy')
                                        <form class="delete-form" action="{{route('admin.projects.destroy', $project)}}" method="POST">
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
            {{$projects->links()}}
        </div>
    @else
        {{-- No hay proyectos para mostrar, se muestran mensajes basados en el rol y el estado del departamento --}}
        @if ($userRoleName === 'Admin')
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                <p class="font-bold">Sin Proyectos Registrados</p>
                <p>No se encontraron proyectos en el sistema.</p>
            </div>
        @elseif (($userRoleName === 'Coord' || $userRoleName === 'Normal'))
            @if (!$userHasDepartment)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">Información Incompleta</p>
                    <p>Tu usuario no está asociado a ningún departamento. Por favor, contacta al administrador para poder visualizar los proyectos.</p>
                </div>
            @else
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                    <p class="font-bold">Sin Proyectos en tu Departamento</p>
                    <p>No hay proyectos registrados para tu departamento.</p>
                </div>
            @endif
        @else
            {{-- Para cualquier otro rol o sin rol asignado --}}
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Acceso Restringido</p>
                <p>No tienes los permisos necesarios para ver proyectos o tu rol no permite esta vista.</p>
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
                        title: "¿Estás Seguro?",
                        text: "¡Vas a Eliminar un Proyecto!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, Eliminar!",
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