<x-filament-panels::page
    @class([ 'fi-resource-edit-record-page' , 'fi-resource-' . str_replace('/', '-' , $this->getResource()::getSlug()),
    'fi-resource-record-' . $record->getKey(),
    ])
    >
    @capture($form)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <x-filament::section heading="Informations">
            <div class="">
                <div class="">Email : {{ $record->email }}</div>
                <div class="">Mobile : {{ $record->mobile }}</div>
                <div class="">Zip : {{ $record->zip }}</div>
                <div class="">Ville : {{ $record->city }}</div>
                <div class="">Profession : {{ $record->professional_status }}</div>
                <div class="">Disponibilités : {{ $record->availability ? implode(', ', $record->availability) : 'N/A' }}</div>
            </div>
        </x-filament::section>
        @if($record->nextFresque)
        <x-filament::section heading="Prochaine fresque">
            <div class="">
                <div class="">{{ $record->nextFresque->place?->name }}</div>
                <div class="">{{ $record->nextFresque->place?->full_address }}</div>
                <div class="">{{ $record->nextFresque->full_date }}</div>
                <div class="">{{ $record->nextFresque->places_left.' places restantes' }}</div>
                <x-filament::link
                    href="{{ route('filament.admin.resources.fresques.view', $record->nextFresque) }}"
                >
                    Accéder à la fresque
                </x-filament::link>
            </div>
        </x-filament::section>
        @else
        <x-filament::section heading="Prochaine fresque">
            Aucune fresque prévue
        </x-filament::section>
        @endif
        <x-filament::section heading="Engagement">
            <div class="">
                <div class="">Notation : {{ $record->rating }}</div>
                <div class="">Type : {{ $record->cadre_type }}</div>
                <div class="">Organisation : {{ $record->cadre_organisation }}</div>
              </div>
        </x-filament::section>
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
        :page-class="static::class">
        @if ($hasCombinedRelationManagerTabsWithContent)
        <x-slot name="content">
            {{ $form() }}
        </x-slot>
        @endif
    </x-filament-panels::resources.relation-managers>
    @endif


</x-filament-panels::page>