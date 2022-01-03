@props(['error'])

@if ($error)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $error }}
    </div>
@endif
