@php 
    $publicUrl = route('fresques.show', $record);
@endphp

<x-filament-panels::header
    :actions="$this->getCachedHeaderActions()"
    :breadcrumbs="filament()->hasBreadcrumbs() ? $this->getBreadcrumbs() : []">
    <x-slot name="heading">
        Fresque #{{ $record->id }}
    </x-slot>

    <x-slot name="subheading">
        <div class="fi-header-subheading mt-2 max-w-2xl text-lg text-gray-600 dark:text-gray-400">{{ $record->place?->name }} - {{ $record->full_date }}</div>
        
        <div class="text-sm mt-2 text-gray-400 flex items-center space-x-2">
            <span>{{  $publicUrl }}</span>
            <button 
                class="text-gray-500 hover:text-gray-700" 
                onclick="copyToClipboard('{{  $publicUrl }}')" 
                title="Copy URL"
            >
                <x-heroicon-o-clipboard class="w-auto h-4"/>
            </button>
        </div>
    </x-slot>

</x-filament-panels::header>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // alert('URL copied to clipboard!');
        }).catch(function(error) {
            console.error('Copy failed!', error);
        });
    }
</script>
