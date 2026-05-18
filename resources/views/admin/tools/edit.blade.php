<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.tools.index')">Herramientas y Consumibles</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.tools.update', $tool)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <flux:input label="N° Memorandum:" name="memo" value="{{old('memo', $tool->memo)}}" placeholder="Escriba el numero de memo de control." />

            <flux:input label="Fecha de recepcion:" type="date" max="2999-12-31" name='date_of_receipt' value="{{old('date_of_receipt', $tool->date_of_receipt->toDateString())}}"/>

            <flux:select label='Clasificacion' name="classification_id" placeholder="Elija por favor...">
                @foreach ($ClassificationTools as $ClassificationTool)
                    <flux:select.option value="{{$ClassificationTool->id}}" :selected="$ClassificationTool->id == old('classification_id', $tool->classification_id)">{{$ClassificationTool->name.' Marca: '.$ClassificationTool->brand.' Modelo: '.$ClassificationTool->model}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="Cantidad:" type='number' name="stock" value="{{old('stock', $tool->stock)}}" placeholder="Escriba la cantidad entregada." />

            <flux:select label='Estatus:' name="statusTool" placeholder="Elija por favor...">
                <flux:select.option value="Optimo" :selected="(old('statusTool', $tool->statusTool) == 'Optimo')">Optimo</flux:select.option>
                <flux:select.option value="Regular" :selected="(old('statusTool', $tool->statusTool) == 'Regular')">Regular</flux:select.option>
                <flux:select.option value="Deteriorado" :selected="(old('statusTool', $tool->statusTool) == 'Deteriorado')">Deteriorado</flux:select.option>
                <flux:select.option value="Averiado" :selected="(old('statusTool', $tool->statusTool) == 'Averiado')">Averiado</flux:select.option>
                <flux:select.option value="Chatarra" :selected="(old('statusTool', $tool->statusTool) == 'Chatarra')">Chatarra</flux:select.option>
                <flux:select.option value="No Operativo" :selected="(old('statusTool', $tool->statusTool) == 'No Operativo')">No Operativo</flux:select.option>
            </flux:select>

            <flux:textarea label="Observaciones:" name="observationsTool" placeholder="Observaciones.">{{old('observations', $tool->observationsTool)}}</flux:textarea>

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>