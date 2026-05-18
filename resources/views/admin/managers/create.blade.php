<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.managers.index')">Respopnsable</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.managers.store')}}" method="POST">
            @csrf
            
            <flux:select label='Selecione la unidad:' name="department_id" placeholder="Elija por favor...">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select label='Selecione el responsable' name="staff_id" placeholder="Elija por favor...">
                @foreach ($staffs as $staff)
                    <flux:select.option value="{{$staff->id}}">{{$staff->name.' '.$staff->last_name}}</flux:select.option>
                @endforeach
            </flux:select>
            
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>