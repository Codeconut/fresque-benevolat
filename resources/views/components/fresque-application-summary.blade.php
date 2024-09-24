<div class="">
    <div class="flex gap-2 items-center justify-center">
        <div class="text-center">
            <x-filament::icon-button icon="heroicon-o-inbox" color="gray" tooltip="Inscrits" size="xl" />
            <div class="text-xl text-gray-400">{{ $record->applications()->where('state', 'registered')->count() }}</div>
        </div>
        <div class="text-center">
            <x-filament::icon-button icon="heroicon-o-check" color="gray" tooltip="Présences confirmées" size="xl" />
            <div class="text-xl text-gray-400">{{ $record->applications()->where('state', 'confirmed_presence')->count() }}</div>
        </div>
        <div class="text-center">
            <x-filament::icon-button icon="heroicon-o-check" color="success" tooltip="Réalisées" size="xl" />
            <div class="text-xl text-gray-400">{{ $record->applications()->where('state', 'validated')->count() }}</div>
        </div>
        <div class="text-center">
            <x-filament::icon-button icon="heroicon-o-x-mark" color="danger" tooltip="Annulées" size="xl" />
            <div class="text-xl text-gray-400">{{ $record->applications()->where('state', 'canceled')->count() }}</div>
        </div>
        <div class="text-center">
            <x-filament::icon-button icon="heroicon-o-exclamation-triangle" color="gray" tooltip="Absents" size="xl" />
            <div class="text-xl text-gray-400">{{ $record->applications()->where('state', 'missing')->count() }}</div>
        </div>
    </div>
</div>