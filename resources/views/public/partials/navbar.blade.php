<header id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 flex justify-center pt-0" style="background:#E8E8E3;border-bottom:1px solid transparent;">
  <div class="relative flex items-center justify-between transition-all duration-500 mx-auto w-full h-20 px-6 md:px-12">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center gap-3 cursor-pointer group z-50">
      <img alt="Aeterna Logo" class="h-8 w-auto transition-all duration-300 nav-logo" style="filter:brightness(0)" src="/site-assets/logo-wite.svg">
      <span class="text-xl font-black tracking-tighter" style="color:#1A1A1A;letter-spacing:-0.04em">AETERNA</span>
    </a>

    <!-- Desktop nav -->
    <nav class="hidden md:flex items-center h-full">
      @foreach($navItems as $item)
        @if($item->children->count())
          <div class="h-full flex items-center px-1">
            <a href="#architecture" data-nav-link
               class="relative px-4 py-1.5 text-sm font-semibold transition-all duration-200 rounded-full hover:bg-[#D6D6CF]"
               style="color:#1A1A1A">
              {{ $item->label }}
            </a>
          </div>
        @else
          <div class="h-full flex items-center px-1">
            <a href="{{ $item->url }}" target="{{ $item->target }}" data-nav-link
               class="relative px-4 py-1.5 text-sm font-semibold transition-all duration-200 rounded-full hover:bg-[#D6D6CF]"
               style="color:#1A1A1A">
              {{ $item->label }}
            </a>
          </div>
        @endif
      @endforeach
      <div class="h-full flex items-center px-1">
        <a href="{{ request()->routeIs('home') ? '#explorer' : route('home').'#explorer' }}" data-nav-link
           class="relative px-4 py-1.5 text-sm font-semibold transition-all duration-200 rounded-full hover:bg-[#D6D6CF]"
           style="color:#1A1A1A">
          Explorer
        </a>
      </div>
    </nav>

    <!-- Right CTAs -->
    <div class="hidden md:flex items-center gap-3">
      <!-- Dark/Light mode toggle -->
      <button id="theme-toggle" aria-label="Toggle dark mode" title="Toggle dark/light mode">
        <!-- Moon icon (shown in light mode) -->
        <svg id="icon-moon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
        <!-- Sun icon (shown in dark mode) -->
        <svg id="icon-sun" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
      </button>

      <a href="#"
         class="shimmer-btn relative overflow-hidden px-6 py-2.5 font-bold text-sm transition-all duration-200"
         style="background:#9FE870;color:#1A1A1A;border-radius:999px;letter-spacing:0.01em;border:none">
        <span class="relative z-10 flex items-center gap-2">
          Start Building
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </span>
      </a>
      <!-- <button onclick="openAppModal()"
         class="px-6 py-2.5 font-semibold text-sm transition-all duration-200 cursor-pointer"
         style="background:#FFFFFF;color:#1A1A1A;border-radius:999px;letter-spacing:0.01em;border:1px solid #C8C8C2">
        Launch App
      </button> -->
    </div>

    <!-- Mobile: theme toggle + hamburger -->
    <div class="md:hidden flex items-center gap-2 z-50">
      <button id="theme-toggle-mobile" aria-label="Toggle dark mode" class="flex items-center justify-center w-9 h-9 rounded-full border" style="border-color:#C8C8C2;background:#FFFFFF;color:#1A1A1A">
        <svg id="icon-moon-mobile" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        <svg id="icon-sun-mobile" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
      </button>
      <button id="menu-toggle" class="flex flex-col gap-1.5 p-2" aria-label="Open menu">
        <span class="menu-bar w-6 h-0.5 block"></span>
        <span class="menu-bar w-6 h-0.5 block"></span>
        <span class="menu-bar w-4 h-0.5 block"></span>
      </button>
    </div>
  </div>
</header>

<!-- Mobile menu -->
<div id="mobile-menu" class="fixed inset-0 z-[60] hidden flex-col p-6" style="background:#E8E8E3">
  <div class="flex justify-between items-center mb-10">
    <div class="flex items-center gap-3">
      <img alt="Aeterna Logo" class="h-7 w-auto" style="filter:brightness(0)" src="/site-assets/logo-wite.svg">
      <span class="text-xl font-black tracking-tighter" style="color:#1A1A1A;letter-spacing:-0.04em">AETERNA</span>
    </div>
    <button id="menu-close" class="p-2" style="color:#6B6B68">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>

  <nav class="flex flex-col gap-1 overflow-y-auto flex-1">
    @foreach($navItems as $item)
      <a href="{{ $item->url }}" class="text-base font-bold uppercase tracking-wider py-3.5 transition"
         style="color:#1A1A1A;border-bottom:1px solid #D6D6CF">
        {{ $item->label }}
      </a>
      @if($item->children->count())
        <div class="pl-4 flex flex-col gap-1 pb-2">
          @foreach($item->children as $child)
            <a href="{{ $child->url }}" class="text-sm py-2 transition" style="color:#6B6B68">
              {{ $child->label }}
            </a>
          @endforeach
        </div>
      @endif
    @endforeach
    <a href="{{ request()->routeIs('home') ? '#explorer' : route('home').'#explorer' }}"
       class="text-base font-bold uppercase tracking-wider py-3.5 transition"
       style="color:#1A1A1A;border-bottom:1px solid #D6D6CF">
      Explorer
    </a>
  </nav>

  <div class="mt-6 flex flex-col gap-3">
    <a href="#" class="text-center py-3.5 font-bold uppercase tracking-wider text-sm"
       style="background:#9FE870;color:#1A1A1A;border-radius:999px">Start Building</a>
    <button onclick="openAppModal()" class="text-center py-3.5 font-semibold uppercase tracking-wider text-sm cursor-pointer w-full"
       style="background:#FFFFFF;color:#1A1A1A;border-radius:999px;border:1px solid #C8C8C2">Launch App</button>
  </div>
</div>

<!-- ── App Modal with Phone Mockup ───────────────────────── -->
<div id="app-modal" onclick="closeAppModal(event)"
     style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);align-items:center;justify-content:center;padding:24px">

  <div style="position:relative;display:flex;flex-direction:column;align-items:center;gap:20px" onclick="event.stopPropagation()">

    <!-- Close button -->
    <button onclick="closeAppModal()"
            style="position:absolute;top:-12px;right:-12px;z-index:10;width:36px;height:36px;border-radius:50%;background:#FFFFFF;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 12px rgba(0,0,0,0.25)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="2.5" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>

    <!-- URL bar -->
    <div style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:999px;padding:8px 18px;display:flex;align-items:center;gap-8px;gap:8px">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      <span style="font-size:13px;color:rgba(255,255,255,0.7);font-family:monospace">app.aeternaio.com</span>
      <a href="https://app.aeternaio.com/" target="_blank"
         style="margin-left:8px;font-size:11px;color:#9FE870;font-weight:600;text-decoration:none">
        Open ↗
      </a>
    </div>

    <!-- Phone mockup -->
    <div style="position:relative;width:340px;height:680px;background:#0D0D0D;border-radius:50px;padding:10px;box-shadow:0 0 0 2px #2A2A2A,0 0 0 4px #1A1A1A,0 30px 80px rgba(0,0,0,0.6),inset 0 0 0 1px rgba(255,255,255,0.05)">

      <!-- Side buttons -->
      <div style="position:absolute;left:-3px;top:110px;width:3px;height:36px;background:#2A2A2A;border-radius:3px 0 0 3px"></div>
      <div style="position:absolute;left:-3px;top:158px;width:3px;height:60px;background:#2A2A2A;border-radius:3px 0 0 3px"></div>
      <div style="position:absolute;left:-3px;top:228px;width:3px;height:60px;background:#2A2A2A;border-radius:3px 0 0 3px"></div>
      <div style="position:absolute;right:-3px;top:158px;width:3px;height:80px;background:#2A2A2A;border-radius:0 3px 3px 0"></div>

      <!-- Screen -->
      <div style="width:100%;height:100%;background:#000;border-radius:42px;overflow:hidden;position:relative">

        <!-- Dynamic island -->
        <div style="position:absolute;top:12px;left:50%;transform:translateX(-50%);width:110px;height:32px;background:#0D0D0D;border-radius:20px;z-index:10"></div>

        <!-- iframe -->
        <iframe src="https://app.aeternaio.com/"
                style="width:100%;height:100%;border:none;display:block"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope"
                loading="lazy"
                title="Aeterna App">
        </iframe>
      </div>

      <!-- Home indicator -->
      <div style="position:absolute;bottom:6px;left:50%;transform:translateX(-50%);width:100px;height:4px;background:rgba(255,255,255,0.3);border-radius:4px"></div>
    </div>

  </div>
</div>

<script>
function openAppModal() {
  var m = document.getElementById('app-modal');
  m.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeAppModal(e) {
  if (e && e.target !== document.getElementById('app-modal')) return;
  document.getElementById('app-modal').style.display = 'none';
  document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.getElementById('app-modal').style.display = 'none';
    document.body.style.overflow = '';
  }
});
</script>
