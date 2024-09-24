<x-filament-panels::page
    @class([ 'fi-resource-edit-record-page' , 'fi-resource-' . str_replace('/', '-' , $this->getResource()::getSlug()),
    'fi-resource-record-' . $record->getKey(),
    ])
    >
    @capture($form)

    <x-slot name="subheading">
        subheading
    </x-slot>

    <div class="grid grid-cols-3 gap-4">
        <x-filament::section heading="Informations">
            <div class="">
                <div class="">En ligne : {{ $record->is_online ? 'Oui' : 'Non' }}</div>
                <div class="">Inscription ouverte : {{ $record->is_registration_open ? 'Oui' : 'Non' }}</div>
                <div class="">Fresque privée : {{ $record->is_private ? 'Oui' : 'Non' }}</div>
                <x-filament::link
                    href="{{ route('fresques.show', $record) }}"
                    target="_blank">
                    Voir la page public
                </x-filament::link>
            </div>
        </x-filament::section>
        <x-filament::section heading="Animateurs">
            <div class="grid">
                @foreach($record->animators as $animator)
                <div class="pb-4">
                    <div class="">{{ $animator->full_name }}</div>
                    <x-filament::link
                        href="{{ route('filament.admin.resources.animators.view', $animator) }}">
                        Voir sa fiche
                    </x-filament::link>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        <x-filament::section heading="Participants">
            @include('components.fresque-places', ['record' => $record])
            @include('components.fresque-application-summary', ['record' => $record])
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