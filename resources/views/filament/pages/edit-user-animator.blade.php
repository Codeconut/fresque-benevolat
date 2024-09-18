<x-filament-panels::page>
    <div class="flex">
        <div>
            <x-filament-panels::form wire:submit="save">
                {{ $this->form }}

                <x-filament-panels::form.actions
                    :actions="$this->getFormActions()" />
            </x-filament-panels::form>
        </div>
        <div>TEST</div>
    </div>
</x-filament-panels::page>