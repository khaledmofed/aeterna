@php
$langs = [
    'en'    => ['fi' => 'us', 'code' => 'EN', 'name' => 'English'],
    'ja'    => ['fi' => 'jp', 'code' => 'JA', 'name' => '日本語'],
    'ko'    => ['fi' => 'kr', 'code' => 'KO', 'name' => '한국어'],
    'es'    => ['fi' => 'es', 'code' => 'ES', 'name' => 'Español'],
    'zh-TW' => ['fi' => 'tw', 'code' => 'TW', 'name' => '繁體中文'],
    'vi'    => ['fi' => 'vn', 'code' => 'VI', 'name' => 'Tiếng Việt'],
];
$currentLocale = app()->getLocale();
$currentLang   = $langs[$currentLocale] ?? $langs['en'];
@endphp

<style>
/* ── Navbar base ─────────────────────────────────────────── */
#main-nav { background: #E8E8E3; border-bottom: 1px solid transparent; }
.dark #main-nav { background: #0E0E0E; border-color: #1C1C1C; }

/* ── Logo / wordmark ─────────────────────────────────────── */
.nav-logo-wrap {
  width: 34px; height: 34px; border-radius: 50%;
  background: #1A1A1A;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; transition: background .3s;
}
.dark .nav-logo-wrap { background: transparent; }
.nav-logo { filter: none; }
.dark .nav-logo { filter: brightness(0) invert(1); }
.nav-wordmark        { color: #1A1A1A; }
.dark .nav-wordmark  { color: #F0F0EC; }

/* ── Nav links ───────────────────────────────────────────── */
[data-nav-link]        { color: #1A1A1A; }
[data-nav-link]:hover  { background: #D6D6CF; }
.dark [data-nav-link]        { color: #D4D4CC; }
.dark [data-nav-link]:hover  { background: #1C1C1C; }

/* ── Theme toggle ────────────────────────────────────────── */
.theme-btn        { color: #1A1A1A; }
.theme-btn:hover  { background: #D6D6CF; }
.dark .theme-btn        { color: #D4D4CC; }
.dark .theme-btn:hover  { background: #1C1C1C; }

/* ── Lang switcher button ────────────────────────────────── */
.lang-btn        { color: #1A1A1A; }
.lang-btn:hover  { background: #D6D6CF; }
.dark .lang-btn        { color: #D4D4CC; }
.dark .lang-btn:hover  { background: #1C1C1C; }

/* ── Dropdown ────────────────────────────────────────────── */
.lang-dropdown {
    background: #FFFFFF;
    border: 1px solid #E0E0DA;
    box-shadow: 0 8px 32px rgba(0,0,0,.12);
}
.dark .lang-dropdown {
    background: #161616;
    border-color: #252525;
    box-shadow: 0 8px 32px rgba(0,0,0,.55);
}
.lang-dropdown-item        { color: #1A1A1A; }
.lang-dropdown-item:hover  { background: #F3F3EE; }
.dark .lang-dropdown-item        { color: #D4D4CC; }
.dark .lang-dropdown-item:hover  { background: #1E1E1E; }
.lang-dropdown-item.active-lang  { font-weight: 700; }
.lang-dropdown-item { white-space: nowrap; }

/* ── Hamburger bars ──────────────────────────────────────── */
.menu-bar        { background: #1A1A1A; }
.dark .menu-bar  { background: #D4D4CC; }

/* ── Mobile menu ─────────────────────────────────────────── */
#mobile-menu        { background: #E8E8E3; }
.dark #mobile-menu  { background: #0E0E0E; }
.mobile-nav-link        { color: #1A1A1A; border-color: #D6D6CF; }
.dark .mobile-nav-link  { color: #D4D4CC; border-color: #1C1C1C; }
.mobile-theme-btn        { background: #FFFFFF; border-color: #C8C8C2; color: #1A1A1A; }
.dark .mobile-theme-btn  { background: #1A1A1A; border-color: #2A2A2A; color: #D4D4CC; }

/* ── Flag icon sizing ────────────────────────────────────── */
.fi { border-radius: 2px; flex-shrink: 0; }
</style>

<header id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 flex justify-center pt-0">
  <div class="relative flex items-center justify-between transition-all duration-500 mx-auto w-full h-20 px-6 md:px-12">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center gap-3 cursor-pointer group z-50">
      <div class="nav-logo-wrap">
        <img alt="Aeterna Logo" class="h-6 w-auto transition-all duration-300 nav-logo" src="/site-assets/logo-wite.svg">
      </div>
      <span class="nav-wordmark text-xl font-black tracking-tighter" style="letter-spacing:-0.04em">AETERNA</span>
    </a>

    <!-- Desktop nav -->
    <nav class="hidden md:flex items-center h-full">
      @foreach($navItems as $item)
        @if($item->children->count())
          <div class="h-full flex items-center px-1">
            <a href="#architecture" data-nav-link
               class="relative px-4 py-1.5 text-sm font-semibold transition-all duration-200 rounded-full">
              {{ $item->label }}
            </a>
          </div>
        @else
          <div class="h-full flex items-center px-1">
            <a href="{{ $item->url }}" target="{{ $item->target }}" data-nav-link
               class="relative px-4 py-1.5 text-sm font-semibold transition-all duration-200 rounded-full">
              {{ $item->label }}
            </a>
          </div>
        @endif
      @endforeach
      <div class="h-full flex items-center px-1">
        <a href="{{ request()->routeIs('home') ? '#explorer' : route('home').'#explorer' }}" data-nav-link
           class="relative px-4 py-1.5 text-sm font-semibold transition-all duration-200 rounded-full">
          {{ __('messages.nav.explorer') }}
        </a>
      </div>
    </nav>

    <!-- Right CTAs -->
    <div class="hidden md:flex items-center gap-2">

      <!-- Theme toggle -->
      <button id="theme-toggle" aria-label="Toggle dark mode"
              class="theme-btn flex items-center justify-center w-9 h-9 rounded-full transition-all">
        <svg id="icon-moon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
        <svg id="icon-sun" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
      </button>

      <!-- Language switcher -->
      <div class="relative" id="lang-switcher-desktop">
        <button id="lang-btn-desktop" onclick="toggleLangDropdown('desktop')"
                class="lang-btn flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold transition-all duration-200 select-none"
                aria-haspopup="true" aria-expanded="false">
          <span class="fi fi-{{ $currentLang['fi'] }}" style="font-size:1.1rem"></span>
          <span style="font-size:0.72rem;font-weight:700;letter-spacing:0.06em">{{ $currentLang['code'] }}</span>
          <svg class="w-3 h-3 transition-transform duration-200" id="lang-chevron-desktop"
               fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="m6 9 6 6 6-6"/>
          </svg>
        </button>

        <div id="lang-dropdown-desktop"
             class="hidden absolute right-0 top-full mt-2 py-1 rounded-2xl z-[100] min-w-[165px] lang-dropdown">
          @foreach($langs as $code => $info)
          <a href="{{ route('locale', $code) }}"
             class="lang-dropdown-item {{ $currentLocale === $code ? 'active-lang' : '' }} flex items-center gap-2.5 px-4 py-2.5 text-sm transition-colors duration-150">
            <span class="fi fi-{{ $info['fi'] }}" style="font-size:1rem"></span>
            <span>{{ $info['name'] }}</span>
            @if($currentLocale === $code)
              <svg class="w-3.5 h-3.5 ml-auto flex-shrink-0" fill="none" stroke="#9FE870" stroke-width="3" viewBox="0 0 24 24">
                <path d="M20 6 9 17l-5-5"/>
              </svg>
            @endif
          </a>
          @endforeach
        </div>
      </div>

    </div>

    <!-- Mobile: theme toggle + hamburger -->
    <div class="md:hidden flex items-center gap-2 z-50">
      <button id="theme-toggle-mobile" aria-label="Toggle dark mode"
              class="mobile-theme-btn flex items-center justify-center w-9 h-9 rounded-full border transition-all">
        <svg id="icon-moon-mobile" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
        <svg id="icon-sun-mobile" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
      </button>
      <button id="menu-toggle" class="flex flex-col gap-1.5 p-2" aria-label="Open menu">
        <span class="menu-bar w-6 h-0.5 block rounded-full transition-all"></span>
        <span class="menu-bar w-6 h-0.5 block rounded-full transition-all"></span>
        <span class="menu-bar w-4 h-0.5 block rounded-full transition-all"></span>
      </button>
    </div>
  </div>
</header>

<!-- Mobile menu -->
<div id="mobile-menu" class="fixed inset-0 z-[60] hidden flex-col p-6">
  <div class="flex justify-between items-center mb-10">
    <div class="flex items-center gap-3">
      <div class="nav-logo-wrap">
        <img alt="Aeterna Logo" class="h-5 w-auto nav-logo" src="/site-assets/logo-wite.svg">
      </div>
      <span class="nav-wordmark text-xl font-black" style="letter-spacing:-0.04em">AETERNA</span>
    </div>
    <button id="menu-close" class="p-2 mobile-nav-link rounded-full">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>

  <nav class="flex flex-col gap-1 overflow-y-auto flex-1">
    @foreach($navItems as $item)
      <a href="{{ $item->url }}" class="mobile-nav-link text-base font-bold uppercase tracking-wider py-3.5 transition"
         style="border-bottom:1px solid">
        {{ $item->label }}
      </a>
      @if($item->children->count())
        <div class="pl-4 flex flex-col gap-1 pb-2">
          @foreach($item->children as $child)
            <a href="{{ $child->url }}" class="mobile-nav-link text-sm py-2 transition" style="border-bottom:none;opacity:0.7">
              {{ $child->label }}
            </a>
          @endforeach
        </div>
      @endif
    @endforeach
    <a href="{{ request()->routeIs('home') ? '#explorer' : route('home').'#explorer' }}"
       class="mobile-nav-link text-base font-bold uppercase tracking-wider py-3.5 transition"
       style="border-bottom:1px solid">
      {{ __('messages.nav.explorer') }}
    </a>
  </nav>

  <!-- Language picker in mobile menu -->
  <div class="mt-6 mb-4">
    <p class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#9FE870;letter-spacing:0.1em">Language</p>
    <div class="grid grid-cols-3 gap-2">
      @foreach($langs as $code => $info)
      <a href="{{ route('locale', $code) }}"
         class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150"
         style="background:{{ $currentLocale === $code ? '#9FE870' : 'transparent' }};
                color:{{ $currentLocale === $code ? '#1A1A1A' : '' }};
                border:1.5px solid {{ $currentLocale === $code ? '#9FE870' : '#3A3A3A' }}">
        <span class="fi fi-{{ $info['fi'] }}" style="font-size:0.9rem"></span>
        <span>{{ $info['code'] }}</span>
      </a>
      @endforeach
    </div>
  </div>

  <div class="flex flex-col gap-3">
    <button onclick="openAppModal()"
            class="mobile-nav-link text-center py-3.5 font-semibold uppercase tracking-wider text-sm cursor-pointer w-full"
            style="border-radius:999px;border:1px solid">
      {{ __('messages.nav.launch_app') }}
    </button>
  </div>
</div>

<!-- ── App Modal ───────────────────────── -->
<div id="app-modal" onclick="closeAppModal(event)"
     style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);align-items:center;justify-content:center;padding:24px">
  <div style="position:relative;display:flex;flex-direction:column;align-items:center;gap:20px" onclick="event.stopPropagation()">
    <button onclick="closeAppModal()"
            style="position:absolute;top:-12px;right:-12px;z-index:10;width:36px;height:36px;border-radius:50%;background:#FFFFFF;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 12px rgba(0,0,0,0.25)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="2.5" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>
    <div style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:999px;padding:8px 18px;display:flex;align-items:center;gap:8px">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      <span style="font-size:13px;color:rgba(255,255,255,0.7);font-family:monospace">app.aeternaio.com</span>
      <a href="https://app.aeternaio.com/" target="_blank" style="margin-left:8px;font-size:11px;color:#9FE870;font-weight:600;text-decoration:none">Open ↗</a>
    </div>
    <div style="position:relative;width:340px;height:680px;background:#0D0D0D;border-radius:50px;padding:10px;box-shadow:0 0 0 2px #2A2A2A,0 0 0 4px #1A1A1A,0 30px 80px rgba(0,0,0,0.6),inset 0 0 0 1px rgba(255,255,255,0.05)">
      <div style="position:absolute;left:-3px;top:110px;width:3px;height:36px;background:#2A2A2A;border-radius:3px 0 0 3px"></div>
      <div style="position:absolute;left:-3px;top:158px;width:3px;height:60px;background:#2A2A2A;border-radius:3px 0 0 3px"></div>
      <div style="position:absolute;left:-3px;top:228px;width:3px;height:60px;background:#2A2A2A;border-radius:3px 0 0 3px"></div>
      <div style="position:absolute;right:-3px;top:158px;width:3px;height:80px;background:#2A2A2A;border-radius:0 3px 3px 0"></div>
      <div style="width:100%;height:100%;background:#000;border-radius:42px;overflow:hidden;position:relative">
        <div style="position:absolute;top:12px;left:50%;transform:translateX(-50%);width:110px;height:32px;background:#0D0D0D;border-radius:20px;z-index:10"></div>
        <iframe src="https://app.aeternaio.com/" style="width:100%;height:100%;border:none;display:block"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope"
                loading="lazy" title="Aeterna App"></iframe>
      </div>
      <div style="position:absolute;bottom:6px;left:50%;transform:translateX(-50%);width:100px;height:4px;background:rgba(255,255,255,0.3);border-radius:4px"></div>
    </div>
  </div>
</div>

<script>
function openAppModal() {
  document.getElementById('app-modal').style.display = 'flex';
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

function toggleLangDropdown(id) {
  var btn      = document.getElementById('lang-btn-' + id);
  var dropdown = document.getElementById('lang-dropdown-' + id);
  var chevron  = document.getElementById('lang-chevron-' + id);
  var isOpen   = !dropdown.classList.contains('hidden');
  dropdown.classList.toggle('hidden', isOpen);
  if (chevron) chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
  btn.setAttribute('aria-expanded', String(!isOpen));
}

document.addEventListener('click', function(e) {
  var wrapper  = document.getElementById('lang-switcher-desktop');
  var dropdown = document.getElementById('lang-dropdown-desktop');
  var chevron  = document.getElementById('lang-chevron-desktop');
  var btn      = document.getElementById('lang-btn-desktop');
  if (wrapper && !wrapper.contains(e.target) && dropdown && !dropdown.classList.contains('hidden')) {
    dropdown.classList.add('hidden');
    if (chevron) chevron.style.transform = '';
    if (btn) btn.setAttribute('aria-expanded', 'false');
  }
});
</script>
