<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Personal</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        {{-- Solo mostramos el botón 'Nuevo' si el usuario tiene el permiso 'admin.staffs.create' --}}
        @can('admin.staffs.create')
            <a class="btn btn-blue text-sm" href="{{ route('admin.staffs.create') }}">Nuevo</a>
        @endcan
    </div>

    {{-- Conditional rendering of the staff table or messages --}}
    @if ($staffs->isNotEmpty())
        {{-- If there are staffs to display --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-xs text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Doc. Identidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre y Apellido
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Adscrito a la unidad:
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usuario Vinculado
                        </th>
                        <th scope="col" class="px-6 py-3" width="20px">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $staff->document_id }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $staff->name . ' ' . $staff->last_name }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $staff->department->name ?? 'N/A' }} {{-- Usamos ?? 'N/A' por si no tiene departamento --}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $staff->user->email ?? 'N/A' }} {{-- Usamos ?? 'N/A' por si no tiene usuario vinculado --}}
                            </th>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    @can('admin.staffs.show') {{-- Asegúrate que el permiso sea el correcto --}}
                                        <flux:button href="{{ route('admin.staffs.show', $staff) }}" icon="eye" class="btn-outline-gray text-xs" title="Ver Información"></flux:button>
                                    @endcan

                                    @can('admin.staffs.edit') {{-- Asegúrate que el permiso sea el correcto --}}
                                        <flux:button href="{{ route('admin.staffs.edit', $staff) }}" icon="pencil" class="btn-outline-yellow text-xs"></flux:button>
                                    @endcan

                                    @can('admin.staffs.destroy') {{-- Asegúrate que el permiso sea el correcto --}}
                                        <form class="delete-form" action="{{ route('admin.staffs.destroy', $staff) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button type="submit" icon="trash" class="btn-outline-red text-xs"></flux:button>
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
            {{ $staffs->links() }}
        </div>
    @else
        {{-- No staffs to display, show messages based on role and department status --}}
        @if ($userRoleName === 'Admin')
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                <p class="font-bold">Sin Personal Registrado</p>
                <p>Como **Admin**, no se encontraron registros de personal en el sistema.</p>
            </div>
        @elseif (($userRoleName === 'Coord' || $userRoleName === 'Normal'))
            @if (!$userHasDepartment)
                {{-- This covers the original `if (!$userHasDepartment)` block --}}
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">Información Incompleta</p>
                    <p>Tu usuario no está asociado a ningún departamento. Por favor, contacta al administrador.</p>
                </div>
            @else
                {{-- If userHasDepartment is true but staffs collection is empty (meaning department has no staff) --}}
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                    <p class="font-bold">Sin Personal en tu Departamento</p>
                    <p>Como **{{ $userRoleName }}**, no hay personal registrado en tu departamento.</p>
                </div>
            @endif
        @else
            {{-- For any other role or no role assigned --}}
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Acceso Restringido</p>
                <p>No tienes los permisos necesarios para ver el personal o tu rol no permite esta vista.</p>
            </div>
        @endif
    @endif

    @push('js')
        <script>
            // Script para la confirmación de eliminación con SweetAlert2
            // Asegúrate de que SweetAlert2 esté incluido en tu proyecto
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estás Seguro?",
                        text: "¡Vas a Eliminar un Personal Administrativo de forma permanente!",
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