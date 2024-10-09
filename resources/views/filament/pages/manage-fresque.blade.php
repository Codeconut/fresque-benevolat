@php $states = config('taxonomies.applications.states'); @endphp

<x-filament-panels::page>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($applications as $application)
        <div class="bg-white p-6 border rounded-xl flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <div>
                <div class="text-lg font-medium"> {{ $application->full_name }}</div>
                <div class="text-sm text-gray-500"> {{ $application->email }}</div>
                <div class="text-sm text-gray-500"> {{ $application->mobile }}</div>
            </div>
            <div>
                <x-filament::dropdown placement="bottom-start" x-on:click="toggle">
                    <x-slot name="trigger">
                        <x-filament::button outlined>
                            <div class="flex items-center gap-3">
                                <span> {{ $states[$application->state] }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </x-filament::button>
                    </x-slot>

                    <x-filament::dropdown.list>
                        <x-filament::dropdown.list.item wire:click="updateState({{ $application->id }} , 'registered');">
                            Inscrit
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item wire:click="updateState({{  $application->id }},'confirmed_presence')">
                            Présence confirmé
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item wire:click="updateState({{  $application->id }},'validated')">
                            Réalisé
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item wire:click="updateState({{  $application->id }},'canceled')">
                            Annulé
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item wire:click="updateState({{  $application->id }},'missing')">
                            Absent
                        </x-filament::dropdown.list.item>

                    </x-filament::dropdown.list>
                </x-filament::dropdown>
            </div>
        </div>
        @endforeach

    </div>



</x-filament-panels::page>