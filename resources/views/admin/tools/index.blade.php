<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Herramientas y Consumibles</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @can('admin.tools.create')
            <a class="btn btn-blue text-sm" href="{{ route('admin.tools.create') }}">Nuevo</a>
        @endcan
    </div>

    {{-- Lógica condicional para mostrar la tabla o un mensaje --}}
    @if ($userHasDepartment || $userRoleName === 'Admin')
        @if ($tools->isEmpty())
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Información!</strong>
                <span class="block sm:inline">No hay herramientas registradas para tu departamento.</span>
            </div>
        @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Herramientas y Consumibles
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Marca
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Modelo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stock
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estatus
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Observaciones
                            </th>
                            <th scope="col" class="px-6 py-3" width="20px">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tools as $tool)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $tool->classification->name }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $tool->classification->brand }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $tool->classification->model }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $tool->stock }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $tool->statusTool }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $tool->observationsTool }}
                                </th>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        @can('admin.tools.edit')
                                            <flux:button href="{{ route('admin.tools.edit', $tool) }}" icon="pencil" class="btn-outline-yellow text-xs">Editar</flux:button>
                                        @endcan

                                        @can('admin.tools.destroy')
                                            <form class="delete-form" action="{{ route('admin.tools.destroy', $tool) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <flux:button type="submit" icon="trash" class="btn-outline-red text-xs">Eliminar</flux:button>
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
                {{ $tools->links() }}
            </div>
        @endif
    @else
        {{-- Mensaje para usuarios sin departamento o sin rol que deba ver herramientas --}}
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Acceso Restringido!</strong>
            <span class="block sm:inline">No tienes permisos para ver las herramientas o tu usuario no está asociado a un departamento.</span>
        </div>
    @endif

    @push('js')
        <script>
            // Script para la confirmación de eliminación con SweetAlert2
            // Asume que tienes SweetAlert2 cargado en tu proyecto
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estás Seguro?",
                        text: "¡Vas a Eliminar una Herramienta!", // Cambiado a "Herramienta"
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