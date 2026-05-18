<x-layouts.app :title="__('Dashboard')">
    @if ($personalCount == 0 && !auth()->user()->hasRole('Admin'))
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
        <p class="font-bold">Información incompleta</p>
        <p>Solicite la carga de su información de personal para ver los datos de su departamento.</p>
    </div>
@else
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- Primer div: Personal en el departamento --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex flex-col justify-center items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Personal del Departamento</h3>
                <p class="mt-2 text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $personalCount }}</p>
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>

            {{-- Segundo div: Cantidad total de Bienes Nacionales --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex flex-col justify-center items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total de Bienes Nacionales</h3>
                <p class="mt-2 text-4xl font-bold text-green-600 dark:text-green-400">{{ $totalBienesNacionales }}</p>
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>

            {{-- Tercer div: Bienes Nacionales con prefijos específicos --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex flex-col justify-center items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Bienes con Prefijo</h3>
                <div class="mt-2 text-center">
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">Duplicate: {{ $duplicateBienesCount }}</p>
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">Sin_Bien: {{ $sinBienBienesCount }}</p>
                </div>
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
@endif
</x-layouts.app>