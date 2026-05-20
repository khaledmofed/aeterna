<button {{ $attributes->merge(['type' => 'submit']) }}
    style="background:#9FE870;color:#1A1A1A;border:none;border-radius:999px;padding:12px 28px;font-size:14px;font-weight:700;letter-spacing:0.01em;cursor:pointer;transition:all 0.2s;display:inline-flex;align-items:center;gap:6px"
    onmouseover="this.style.background='#8ED85F'" onmouseout="this.style.background='#9FE870'">
    {{ $slot }}
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
</button>
