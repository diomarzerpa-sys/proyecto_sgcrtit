<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.classifications.index')">Clasificacion de Bienes</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.classifications.store')}}" method="POST" class="space-y-4">
            @csrf

            <flux:select label='Tpo de Clasificación' name="type" placeholder="Elija por favor...">
                <flux:select.option value="Mobiliario" :selected="old('type')">Mobiliario</flux:select.option>
                <flux:select.option value="Oficina" :selected="old('type')">Oficina</flux:select.option>
                <flux:select.option value="Tecnologico" :selected="old('type')">Tecnologico</flux:select.option>
                <flux:select.option value="Processor" :selected="old('type')">Procesador</flux:select.option>
                <flux:select.option value="Hardisk" :selected="old('type')">Disco Duro</flux:select.option>
                <flux:select.option value="Video_card" :selected="old('type')">Tarjeta de Video</flux:select.option>
                <flux:select.option value="Audio_card" :selected="old('type')">Tarjeta de Audio</flux:select.option>
                <flux:select.option value="Motherboard" :selected="old('type')">Tarjeta de Madre</flux:select.option>
                <flux:select.option value="SO" :selected="old('type')">Sistema Operativo</flux:select.option>
                <flux:select.option value="OF" :selected="old('type')">Ofimatica</flux:select.option>
                <flux:select.option value="NV" :selected="old('type')">Navegadores</flux:select.option>
            </flux:select>
            
            <flux:input label="Nombre:" name="name" value="{{old('name')}}" placeholder="Escriba el nombre de la nueva clasificacion." />

            <flux:input label="Marca:" name="brand" value="{{old('brand')}}" placeholder="Escriba a que marca pertenece la nueva clasificacion." />

            <flux:input label="Modelo:" name="model" value="{{old('model')}}" placeholder="Escriba el modelo de la nueva clasificacion." />

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>