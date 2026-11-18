@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'status status--success']) }}>
        {{ $status }}
    </div>
@endif
