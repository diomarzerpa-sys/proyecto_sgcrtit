<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.classifications.index')">Clasificacion de Bien Nacional</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.classifications.update', $classification)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <flux:select label='Tpo de Clasificación' name="type" placeholder="Elija por favor...">
                <flux:select.option value="Mobiliario" :selected="(old('type', $classification->type) == 'Mobiliario')">Mobiliario</flux:select.option>
                <flux:select.option value="Oficina" :selected="(old('type', $classification->type) == 'Oficina')">Oficina</flux:select.option>
                <flux:select.option value="Tecnologico" :selected="(old('type', $classification->type) == 'Tecnologico')">Tecnologico</flux:select.option>
                <flux:select.option value="Processor" :selected="(old('type', $classification->type) == 'Processor')">Procesador</flux:select.option>
                <flux:select.option value="Hardisk" :selected="(old('type', $classification->type) == 'Hardisk')">Disco Duro</flux:select.option>
                <flux:select.option value="Video_card" :selected="(old('type', $classification->type) == 'Video_card')">Tarjeta de Video</flux:select.option>
                <flux:select.option value="Audio_card" :selected="(old('type', $classification->type) == 'Audio_card')">Tarjeta de Audio</flux:select.option>
                <flux:select.option value="Motherboard" :selected="(old('type', $classification->type) == 'Motherboard')">Tarjeta de Madre</flux:select.option>
                <flux:select.option value="SO" :selected="(old('type', $classification->type) == 'SO')">Sistema Operativo</flux:select.option>
                <flux:select.option value="OF" :selected="(old('type', $classification->type) == 'OF')">Ofimatica</flux:select.option>
                <flux:select.option value="NV" :selected="(old('type', $classification->type) == 'NV')">Navegadores</flux:select.option>
            </flux:select>
            
            <flux:input label="Nombre:" name="name" value="{{old('name', $classification->name)}}" placeholder="Escriba el nombre de la nueva clasificación." />

            <flux:input label="Marca:" name="brand" value="{{old('brand', $classification->brand)}}" placeholder="Escriba a que marca pertenece la nueva clasificacion." />

            <flux:input label="Modelo:" name="model" value="{{old('model', $classification->model)}}" placeholder="Escriba el modelo de la nueva clasificacion." />

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>