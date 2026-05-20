@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full rounded-xl border text-sm transition-all duration-200', 'style' => 'background:#F5F4F0;border-color:#D6D6CF;color:#1A1A1A;padding:12px 16px;outline:none;']) }}>
