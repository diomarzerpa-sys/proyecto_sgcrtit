<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Categorias</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @can('admin.categories.create')
            <a class="btn btn-blue text-sm" href="{{route('admin.categories.create')}}">Nuevo</a>
        @endcan
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Unidad Administrativa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Categoria
                    </th>
                    <th scope="col" class="px-6 py-3" width="20px">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$category->department->name}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$category->name}}
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                @can('admin.categories.edit')
                                    <flux:button href="{{route('admin.categories.edit',$category)}}" icon="pencil" class="btn-outline-yellow text-xs">Edit</flux:button>
                                @endcan
                            
                                @can('admin.categories.destroy')
                                    <form class="delete-form" action="{{route('admin.categories.destroy', $category)}}" method="POST">
                                        
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
        {{$categories->links()}}
    </div>

    @push('js')
        <script>
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estas Seguro?",
                        text: "¡Vas a Eliminar una Categoria!",
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