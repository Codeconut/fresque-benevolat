<x-filament-panels::page.simple>
    <x-slot name="heading">
        {{ auth()->user()->animator->full_name }}
    </x-slot>

    <x-slot name="subheading">
        Complétez vos informations
    </x-slot>

    <x-filament-panels::form wire:submit="save">
        <div class="mb-6">
            {{ $this->form }}
        </div>
        <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
            :full-width="true" />
    </x-filament-panels::form>

</x-filament-panels::page.simple>