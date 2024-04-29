<?php $animators = $fresque->animators
    ->map(function ($animator) {
        return $animator->first_name;
    })
    ->toArray();
?>

{{ $slot }}
@if (count($animators) > 0)
    <br> {{ implode('& ', $animators) }} 🌞
@else
    <br> Les animateurs 🌞
@endif
