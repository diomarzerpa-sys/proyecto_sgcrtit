<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.managers.index')">Responsable</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.managers.update', $manager)}}" method="POST">
            @csrf
            @method('PUT')
            
             <flux:select label='Selecione la unidad a la que pertenece' name="department_id">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}" :selected="$department->id == old('department_id', $manager->department_id)">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

             <flux:select label='Selecione la unidad a la que pertenece' name="staff_id">
                @foreach ($staffs as $staff)
                    <flux:select.option value="{{$staff->id}}" :selected="$staff->id == old('staff_id', $manager->user_id)">{{$staff->name}}</flux:select.option>
                @endforeach
            </flux:select>
            
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>