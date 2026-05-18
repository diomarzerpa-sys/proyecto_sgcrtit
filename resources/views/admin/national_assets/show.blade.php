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
            <flux:breadcrumbs.item>Ver</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Bien Nacional
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{$nationalAsset->code}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           Serial:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->serial}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           Tipo de clasificacion:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->typeNA}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Clasificacion:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->classification->name}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Marca:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->classification->brand}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Modelo:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->classification->model}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Estatus:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->status}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Descripcion:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->description}}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Unidad a la que pertenece:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->department->name}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Responsable por uso:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->responsible_for_use}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Observaciones:
                        </th>
                        <td class="px-6 py-4">
                            {{$nationalAsset->observations}}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <center><a class="btn-outline-gray text-sm" href="{{route('admin.national_assets.index')}}">Volver</a></center>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    
</x-layouts.app>