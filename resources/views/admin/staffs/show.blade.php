<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.staffs.index')">Personal</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Ver Ficha Tecnica</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Usuario Vinculado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{$staff->user->email}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nombres:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->name}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apellidos:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->last_name}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Documento de Identidad:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->document_id}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Fecha de Ingreso:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->entry_date->format('d-m-Y')}}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Dirección:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->address}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Telefono:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->phone}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Unidad de adscripcion:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->department->name}}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Observación:
                        </th>
                        <td class="px-6 py-4">
                            {{$staff->observations}}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <center><a class="btn-outline-gray text-sm" href="{{route('admin.staffs.index')}}">Volver</a></center>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>