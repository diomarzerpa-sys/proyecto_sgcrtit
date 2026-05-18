<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.staffs.index')">Personal</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.staffs.update', $staff)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <flux:select label='Usuario Vinculado:' name="user_id" placeholder="Elija por favor...">
                @foreach ($users as $user)
                    <flux:select.option value="{{$user->id}}" :selected="$user->id == old('user_id', $staff->user_id)">{{$user->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="Nombres:" name="name" value="{{old('name',$staff->name)}}" placeholder="Escriba el nombre del trabajador." />

            <flux:input label="Apellidos:" name="last_name" value="{{old('last_name',$staff->last_name)}}" placeholder="Escriba el apellido del trabajador." />
            
            <flux:input label="Documento de Identidad:" name="document_id" value="{{old('document_id',$staff->document_id)}}" placeholder="Cedula o Pasaporte." />

            <flux:input label="Fecha de Entrada:" name="entry_date" type="date" max="2999-12-31" value="{{old('entry_date',$staff->entry_date->toDateString())}}" />

            <flux:textarea label="Dirección:" name="address" placeholder="Escriba la direccion de vivienda.">{{old('address',$staff->address)}}</flux:textarea>

            <flux:input label="Telefono:" name="phone" mask="(9999) 999-9999" value="{{old('phone',$staff->phone)}}" />

            <flux:select label='Unidad Adjunta' name="department_id" placeholder="Elija por favor...">
                @foreach ($departments as $department)
                    <flux:select.option value="{{$department->id}}" :selected="$department->id == old('department_id', $staff->department_id)">{{$department->name}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:textarea label="Observaciones:" name="observations" placeholder="Observaciones.">{{old('observations')}}</flux:textarea>

            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>