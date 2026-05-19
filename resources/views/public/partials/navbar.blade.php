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
          <div class="h-full flex items-center relative group/arch">
            <button class="relative px-4 py-1.5 text-sm font-semibold transition-all duration-200 h-full flex items-center gap-1 rounded-full hover:bg-[#D6D6CF]" style="color:#1A1A1A">
              {{ $item->label }}
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/arch:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            {{-- Mega menu --}}
            <div class="mega-menu-bg fixed top-20 left-0 right-0 w-full
                        shadow-[0_8px_32px_rgba(0,0,0,0.08)]
                        overflow-hidden opacity-0 invisible pointer-events-none
                        group-hover/arch:opacity-100 group-hover/arch:visible group-hover/arch:pointer-events-auto
                        transition-all duration-200"
                 style="background:#FFFFFF;border-top:1px solid #D6D6CF;border-bottom:1px solid #D6D6CF;">
              <div class="container mx-auto px-6 py-10">

                <div class="flex items-center gap-4 mb-6" style="color:#9A9A96">
                  <span class="text-xs font-mono tracking-widest uppercase">CORE //</span>
                  <h3 class="text-base font-bold uppercase tracking-widest" style="color:#1A1A1A">Aeterna 4-Layer Stack</h3>
                </div>

                <div class="relative grid grid-cols-2 md:grid-cols-4" style="border-top:1px solid #D6D6CF;border-left:1px solid #D6D6CF">
                  @php
                  $megaItems = [
                    ['href'=>'#layer-infrastructure','title'=>'Infrastructure','sub'=>'Aeterna Core + SDK','icon'=>'<rect width="20" height="8" x="2" y="2" rx="2" ry="2"/><rect width="20" height="8" x="2" y="14" rx="2" ry="2"/><line x1="6" x2="6.01" y1="6" y2="6"/><line x1="6" x2="6.01" y1="18" y2="18"/>'],
                    ['href'=>'#ai-core-engine','title'=>'AI Engine','sub'=>'Aeterna Inference + Subnet','icon'=>'<path d="M12 18V5"/><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"/>'],
                    ['href'=>'#chain-abstraction','title'=>'Abstraction','sub'=>'Universal Address','icon'=>'<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>'],
                    ['href'=>'#layer-payment','title'=>'Payment','sub'=>'Aeterna AP2 + x402','icon'=>'<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>'],
                    ['href'=>'#tech-consensus','title'=>'Aeterna DAG','sub'=>'160K+ TPS','icon'=>'<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>'],
                    ['href'=>'#tech-vm','title'=>'Multi-VM','sub'=>'Rust/Move/EVM','icon'=>'<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="8" y="8" width="8" height="8" rx="1"/>'],
                  ];
                  @endphp
                  @foreach($megaItems as $mi)
                  <a href="{{ $mi['href'] }}"
                     class="group relative border-r border-b p-7 transition-colors duration-150 hover:bg-[#F0F0EA]"
                     style="border-color:#D6D6CF">
                    <div class="flex justify-between items-start">
                      <div>
                        <h4 class="text-base font-bold mb-1 uppercase transition-colors" style="color:#1A1A1A;letter-spacing:-0.01em">{{ $mi['title'] }}</h4>
                        <span class="text-xs transition-colors" style="color:#6B6B68">{{ $mi['sub'] }}</span>
                      </div>
                      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                           class="w-9 h-9 shrink-0 transition-all duration-200 group-hover:scale-110"
                           style="color:#1A1A1A"
                           aria-hidden="true">
                        {!! $mi['icon'] !!}
                      </svg>
                    </div>
                  </a>
                  @endforeach
                </div>
              </div>
            </div>
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
