<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.users.index')">Usuario</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.users.update', $user)}}" method="POST" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <flux:input label="Nombres:" name="name" value="{{old('name', $user->name)}}" placeholder="Escriba el nombre del trabajador." />

            <flux:input label="E-mail:" name="email" value="{{old('email', $user->email)}}" placeholder="Escriba el correo del trabajador." />

                    <!-- Password -->
            <flux:input label="Contraseña:" type="password" name="password" value="{{old('password')}}" placeholder="Escriba la contraseña del trabajador." />

            <flux:input label="Confirme Contraseña:" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Escriba la contraseña nuevamente del trabajador." />

            <!-- REEMPLAZA TU BLOQUE DE ROLES POR ESTE -->
            <flux:select label='Roles dentro del sistema' name="roles" placeholder="Elija los roles por favor...">
                @foreach ($roles as $role)
                    <flux:select.option value="{{ $role->id }}"
                        :selected="$role->id == old('roles', $user->roles->first()?->id)">
                        {{ $role->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>


            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Modificar</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>