<div class="px-3 py-4">
    <div class="flex gap-2 items-center justify-center">
        <div class="flex items-end">
            <div class="text-3xl">{{ $record->applications()->whereIn('state', ['registered', 'confirmed_presence', 'validated'])->count() }}</div>
            <div class="text-sm relative -top-1 text-gray-600">/{{ $record->places }}</div>
        </div> 
    </div>
</div>