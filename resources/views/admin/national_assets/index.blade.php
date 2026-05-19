<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Bienes Nacionales</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @can('admin.national_assets.create')
            <a class="btn btn-blue text-sm" href="{{route('admin.national_assets.create')}}">Nuevo</a>
        @endcan
    </div>

    <livewire:NationalAssetTable />


    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {
            Livewire.on('delete-confirm', (event) => {
            const rowId = event.rowId; // Access rowId from the event object

                    Swal.fire({
                        title: "¿Estas Seguro?",
                        text: "¡Vas a Eliminar un Unidad Administrativa!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, Eliminar!",
                        cancelButtonText: "Cancelar"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch('delete', { rowId: rowId });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>