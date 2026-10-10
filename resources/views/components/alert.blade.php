@props([
    'type' => 'success',
])

@php
    $icons = [
        'success' => '✓',
        'info'    => 'ℹ',
        'warning' => '⚠',
        'danger'  => '✕',
    ];
    $icon = $icons[$type] ?? '✓';
@endphp

<div {{ $attributes->merge(['class' => 'alert alert-' . $type]) }} role="alert">
    <div class="alert-icon-wrapper">
        <span class="alert-icon-symbol">{{ $icon }}</span>
    </div>
    <div class="alert-body">
        {{ $slot }}
    </div>
</div>
