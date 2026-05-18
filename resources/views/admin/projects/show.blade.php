<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.projects.index')">Proyectos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Ver</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="car">
            <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Proyecto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{$project->id}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de registro:
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{$project->created_at->format('d-m-Y')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Categoria a la que pertenece:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            {{$project->category->name}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Titulo:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            {{$project->title}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Fecha de Inicio:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            {{$project->date_start->format('d-m-Y')}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Fecha de Culminacion:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            @if (!$project->date_finish)
                               Fecha de culminacion sin especificar
                            @else
                                {{$project->date_finish->format('d-m-Y')}}
                            @endif
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Estado actual:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                                {{$project->status}}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Contenido:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                            {!!$project->content!!}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Participantes:
                        </th>
                        <td class="px-6 py-4" colspan="3">
                                @foreach ($project->staffs as $item)
                                {{$item->name.' '.$item->last_name}}</br>
                                @endforeach
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" colspan="4" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <center><a class="btn-outline-gray text-sm" href="{{route('admin.projects.index')}}">Volver</a></center>
                        </th>
                    </tr>
                </tbody>
            </table>
    </div>
</x-layouts.app>