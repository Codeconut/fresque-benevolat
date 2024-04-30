<div style="text-align: center; margin-bottom: 32px;">
    <div style="font-size: 32px; font-weight: bold; color: #161616;">{{ $fresque->place->name }}</div>
    <div style="font-size: 32px; font-weight: bold; color: #161616;">le
        {{ \Carbon\Carbon::parse($fresque->date)->translatedFormat('d F Y') }} de {{ $fresque->schedules }}</div>
    <div style="margin-top: 12px;">{{ $fresque->place->full_address }}</div>
</div>
