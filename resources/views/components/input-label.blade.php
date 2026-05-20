@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold mb-1.5']) }} style="color:#1A1A1A;letter-spacing:-0.01em">
    {{ $value ?? $slot }}
</label>
