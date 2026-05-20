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
          {{-- Items with children → simple scroll link to section, no dropdown --}}
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
    </nav>

    <!-- Right CTAs -->
    <div class="hidden md:flex items-center gap-3">
      <a href="#"
         class="shimmer-btn relative overflow-hidden px-6 py-2.5 font-bold text-sm transition-all duration-200"
         style="background:#9FE870;color:#1A1A1A;border-radius:999px;letter-spacing:0.01em;border:none">
        <span class="relative z-10 flex items-center gap-2">
          Start Building
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </span>
      </a>
      <a href="https://app.aeternaio.com/" target="_blank"
         class="px-6 py-2.5 font-semibold text-sm transition-all duration-200"
         style="background:#FFFFFF;color:#1A1A1A;border-radius:999px;letter-spacing:0.01em;border:1px solid #C8C8C2">
        Launch App
      </a>
    </div>

    <!-- Mobile hamburger -->
    <button id="menu-toggle" class="md:hidden flex flex-col gap-1.5 p-2 z-50" aria-label="Open menu">
      <span class="w-6 h-0.5 block" style="background:#1A1A1A"></span>
      <span class="w-6 h-0.5 block" style="background:#1A1A1A"></span>
      <span class="w-4 h-0.5 block" style="background:#1A1A1A"></span>
    </button>
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
  </nav>

  <div class="mt-6 flex flex-col gap-3">
    <a href="#" class="text-center py-3.5 font-bold uppercase tracking-wider text-sm"
       style="background:#9FE870;color:#1A1A1A;border-radius:999px">Start Building</a>
    <a href="https://app.aeternaio.com/" target="_blank" class="text-center py-3.5 font-semibold uppercase tracking-wider text-sm"
       style="background:#FFFFFF;color:#1A1A1A;border-radius:999px;border:1px solid #C8C8C2">Launch App</a>
  </div>
</div>
