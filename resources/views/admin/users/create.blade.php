<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.managers.index')">Usuario</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.users.store')}}" method="POST" class="flex flex-col gap-6">
            @csrf

            <flux:input label="Nombres:" name="name" value="{{old('name')}}" placeholder="Escriba el nombre del trabajador." />

            <flux:input label="E-mail:" name="email" value="{{old('email')}}" placeholder="Escriba el correo del trabajador." />

                    <!-- Password -->
            <flux:input label="Contraseña:" type="password" name="password" value="{{old('password')}}" placeholder="Escriba la contraseña del trabajador." />

            <flux:input label="Confirme Contraseña:" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Escriba la contraseña nuevamente del trabajador." />


            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>