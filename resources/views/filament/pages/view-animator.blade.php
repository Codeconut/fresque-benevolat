<x-filament-panels::page
    @class([
        'fi-resource-edit-record-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
        'fi-resource-record-' . $record->getKey(),
    ])
>
    @capture($form)
    <div class="grid grid-cols-3 gap-4">
        <div class=" bg-white rounded border p-4">
            <div class="">{{ $record->professional_status }}</div>
            <div class="">{{ $record->mobile }}</div>
            <div class="">{{ $record->zip }}</div>
            <div class="">{{ $record->city }}</div>
        </div>
        <div class="bg-white rounded border p-4">
            <div class="">Prochaine fresque</div>
        </div>
        <div class="bg-white rounded border p-4">
            <div class="">Info privée</div>
        </div>
    </div>
       
    @endcapture

    @php
        $relationManagers = $this->getRelationManagers();
        $hasCombinedRelationManagerTabsWithContent = $this->hasCombinedRelationManagerTabsWithContent();
    @endphp

    @if ((! $hasCombinedRelationManagerTabsWithContent) || (! count($relationManagers)))
        {{ $form() }}
    @endif

    @if (count($relationManagers))
        <x-filament-panels::resources.relation-managers
            :active-locale="isset($activeLocale) ? $activeLocale : null"
            :active-manager="$this->activeRelationManager ?? ($hasCombinedRelationManagerTabsWithContent ? null : array_key_first($relationManagers))"
            :content-tab-label="$this->getContentTabLabel()"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        >
            @if ($hasCombinedRelationManagerTabsWithContent)
                <x-slot name="content">
                    {{ $form() }}
                </x-slot>
            @endif
        </x-filament-panels::resources.relation-managers>
    @endif

 
</x-filament-panels::page>