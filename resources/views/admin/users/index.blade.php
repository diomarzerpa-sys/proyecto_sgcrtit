<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Usuarios</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @can('admin.users.create')
            <a class="btn btn-blue text-sm" href="{{route('admin.users.create')}}">Nuevo</a>
        @endcan

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Usuario
                    </th>
                    <th scope="col" class="px-6 py-3">
                        email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        viculado
                    </th>
                    <th scope="col" class="px-6 py-3" width="20px">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$user->name}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$user->email}}
                        </th>
                        @if($user->is_vinculed=='1')
                        <th scope="row" style="background-color:rgb(8, 253, 20);" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Vinculado
                        </th>
                        @else
                        <th scope="row" style="background-color:rgb(253, 8, 8);" class="px-6 py-4 font-medium bg-red text-gray-900 whitespace-nowrap dark:text-white">
                            No vinculado
                        </th>
                        @endif
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">

                                @can('admin.users.edit')
                                    <flux:button href="{{route('admin.users.edit',$user)}}" icon="pencil" class="btn-outline-yellow text-xs">Edit</flux:button>
                                @endcan
                            
                                @can('admin.users.destroy')
                                    <form class="delete-form" action="{{route('admin.users.destroy', $user)}}" method="POST">
                                        
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
        {{$users->links()}}
    </div>

    @push('js')
        <script>
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estas Seguro?",
                        text: "¡Vas a Eliminar un responsable!",
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