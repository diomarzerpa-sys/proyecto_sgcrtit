<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Clasificación de Bienes</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @can('admin.classifications.create')
            <a class="btn btn-blue text-sm" href="{{route('admin.classifications.create')}}">Nuevo</a>
        @endcan
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tipo</th>
                    <th scope="col" class="px-6 py-3">Clasificación</th>
                    <th scope="col" class="px-6 py-3">Marca</th>
                    <th scope="col" class="px-6 py-3">Modelo</th>
                    <th scope="col" class="px-6 py-3 text-center" width="20px">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classifications as $classification)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 row-active">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $classification->type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $classification->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $classification->brand }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $classification->model }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2 justify-center">
                                @can('admin.classifications.edit')
                                    <flux:button href="{{ route('admin.classifications.edit', $classification) }}" icon="pencil" class="btn-outline-orange text-xs">Editar</flux:button>
                                @endcan

                                @can('admin.classifications.destroy')
                                    <form action="{{ route('admin.classifications.destroy', $classification) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" icon="trash" class="btn-outline-red text-xs">Eliminar</flux:button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No se encontraron clasificaciones registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $classifications->links() }}
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const forms = document.querySelectorAll('.delete-form');

                forms.forEach(form => {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();

                        Swal.fire({
                            title: "¿Estás Seguro?",
                            text: "¡Vas a Eliminar un tipo de clasificación!",
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
            });
        </script>
    @endpush
</x-layouts.app>