<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.categories.index')">Categorias</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.categories.update', $category)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <flux:input label="Categoria:" name="name" value="{{old('name', $category->name)}}" placeholder="Escriba el nombre de la nueva categoria." />
            
            <flux:select label='Selecione la unidad a la que pertenece' name="department_id">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}" :selected="$department->id == old('department_id', $category->department_id)">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>