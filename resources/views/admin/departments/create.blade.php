<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.departments.index')">Unidades Administrativas</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.departments.store')}}" method="POST">
            @csrf
            
            <flux:input label="Unidad Administrativa" name="name" value="{{old('name')}}" placeholder="Escriba el nombre de la nueva unidad." />
            
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>