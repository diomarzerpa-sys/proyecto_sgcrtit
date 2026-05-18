<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.memos.index')">Memorandum</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Ver</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="car">
            <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Memorandum
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{$memo->nro_control}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha:
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{$memo->date_created->format('d-m-Y')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Categoria a la que pertenece:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            {{$memo->category->name}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Titulo:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            {{$memo->title}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Contenido:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            {!!$memo->content!!}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Dirigido a:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                             @if ($memo->addressed_to)
                                {{$memo->addressed_to}}</br>
                                @foreach ($memo->departments as $item)
                                {{$item->manager->staff->name." - ".$item->name}}</br>
                                @endforeach
                            @else
                                @foreach ($memo->departments as $item)
                                {{$item->manager->staff->name." - ".$item->name}}</br>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" colspan="4" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <center><a class="btn-outline-gray text-sm" href="{{route('admin.memos.index')}}">Volver</a></center>
                        </th>
                    </tr>
                </tbody>
            </table>
    </div>
</x-layouts.app>