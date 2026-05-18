<header id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 flex justify-center pt-0">
  <div class="relative flex items-center justify-between transition-all duration-500 mx-auto w-full h-20 bg-black/90 backdrop-blur-md border-b border-white/10 px-6 md:px-12">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center gap-3 cursor-pointer group z-50">
      <img alt="Aeterna Logo" class="h-8 w-auto transition-all duration-300" src="/site-assets/logo-wite.svg">
      <span class="text-xl font-bold tracking-tighter text-[#EBFF00]">AETERNA</span>
    </a>

    <!-- Desktop nav -->
    <nav class="hidden md:flex items-center h-full">
      @foreach($navItems as $item)
        @if($item->children->count())
          {{-- Architecture — mega dropdown --}}
          <div class="h-full flex items-center relative group/arch">
            <button class="relative px-6 py-2 text-sm font-bold uppercase tracking-wider transition-all duration-300 h-full flex items-center hover:scale-110 origin-center text-neutral-400 hover:text-white gap-1">
              {{ $item->label }}
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/arch:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            {{-- Mega menu --}}
            <div class="fixed top-20 left-0 right-0 w-full
                        bg-black border-y border-[#EBFF00]/30 shadow-[0_20px_50px_rgba(0,0,0,0.9)]
                        overflow-hidden opacity-0 invisible pointer-events-none
                        group-hover/arch:opacity-100 group-hover/arch:visible group-hover/arch:pointer-events-auto
                        transition-all duration-200">
              <div class="container mx-auto px-6 py-12">

                {{-- Header --}}
                <div class="flex items-center gap-4 mb-8 text-[#EBFF00]/80">
                  <span class="text-sm font-mono">CORE //</span>
                  <h3 class="text-xl font-bold uppercase tracking-widest">Aeterna 4-Layer Stack</h3>
                </div>

                {{-- Grid --}}
                <div class="relative grid grid-cols-2 md:grid-cols-4 border-t border-l border-[#EBFF00]/30">
                  {{-- Corner brackets --}}
                  <div class="absolute -top-[3px] -left-[3px] w-4 h-4 border-t-2 border-l-2 border-[#EBFF00] pointer-events-none"></div>
                  <div class="absolute -top-[3px] -right-[3px] w-4 h-4 border-t-2 border-r-2 border-[#EBFF00] pointer-events-none"></div>
                  <div class="absolute -bottom-[3px] -left-[3px] w-4 h-4 border-b-2 border-l-2 border-[#EBFF00] pointer-events-none"></div>
                  <div class="absolute -bottom-[3px] -right-[3px] w-4 h-4 border-b-2 border-r-2 border-[#EBFF00] pointer-events-none"></div>

                  @php
                  $megaItems = [
                    ['href'=>'#layer-infrastructure','title'=>'Infrastructure','sub'=>'Aeterna Core + SDK',
                     'icon'=>'<rect width="20" height="8" x="2" y="2" rx="2" ry="2"/><rect width="20" height="8" x="2" y="14" rx="2" ry="2"/><line x1="6" x2="6.01" y1="6" y2="6"/><line x1="6" x2="6.01" y1="18" y2="18"/>'],
                    ['href'=>'#ai-core-engine','title'=>'AI Engine','sub'=>'Aeterna Inference + Subnet',
                     'icon'=>'<path d="M12 18V5"/><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"/><path d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 1 0-5.598 1.5"/><path d="M17.997 5.125a4 4 0 0 1 2.526 5.77"/><path d="M18 18a4 4 0 0 0 2-7.464"/><path d="M19.967 17.483A4 4 0 1 1 12 18a4 4 0 1 1-7.967-.517"/><path d="M6 18a4 4 0 0 1-2-7.464"/><path d="M6.003 5.125a4 4 0 0 0-2.526 5.77"/>'],
                    ['href'=>'#chain-abstraction','title'=>'Abstraction','sub'=>'Universal Address',
                     'icon'=>'<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>'],
                    ['href'=>'#layer-payment','title'=>'Payment','sub'=>'Aeterna AP2 + x402',
                     'icon'=>'<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>'],
                    ['href'=>'#tech-consensus','title'=>'Aeterna DAG','sub'=>'160K+ TPS',
                     'icon'=>'<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>'],
                    ['href'=>'#tech-vm','title'=>'Multi-VM','sub'=>'Rust/Move/EVM',
                     'icon'=>'<path d="M12 20v2"/><path d="M12 2v2"/><path d="M17 20v2"/><path d="M17 2v2"/><path d="M2 12h2"/><path d="M2 17h2"/><path d="M2 7h2"/><path d="M20 12h2"/><path d="M20 17h2"/><path d="M20 7h2"/><path d="M7 20v2"/><path d="M7 2v2"/><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="8" y="8" width="8" height="8" rx="1"/>'],
                  ];
                  @endphp

                  @foreach($megaItems as $mi)
                  <a href="{{ $mi['href'] }}"
                     class="group relative border-r border-b border-[#EBFF00]/30 p-8 hover:bg-[#EBFF00] transition-colors duration-0">
                    <div class="flex justify-between items-start">
                      <div>
                        <h4 class="text-xl font-bold text-[#EBFF00] group-hover:text-black mb-1 uppercase">{{ $mi['title'] }}</h4>
                        <span class="text-xs text-neutral-500 group-hover:text-black/70">{{ $mi['sub'] }}</span>
                      </div>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                           class="w-10 h-10 stroke-1 shrink-0 text-[#EBFF00] group-hover:text-black group-hover:scale-110 transition-transform duration-300"
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
          <div class="h-full flex items-center opacity-0 animate-scale-in">
            <a href="{{ $item->url }}" target="{{ $item->target }}" data-nav-link
               class="relative px-6 py-2 text-sm font-bold uppercase tracking-wider transition-all duration-300 h-full flex items-center hover:scale-110 origin-center text-neutral-400 hover:text-white">
              {{ $item->label }}
            </a>
          </div>
        @endif
      @endforeach
    </nav>

    <!-- Right CTA -->
    <div class="hidden md:flex items-center gap-3">
      <a href="#"
         class="relative overflow-hidden group px-6 py-2 rounded-full font-semibold text-sm uppercase tracking-wider border-2 border-[#EBFF00] bg-[#EBFF00] text-black transition-all duration-300 hover:bg-white hover:border-white">
        <div class="absolute inset-0 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] bg-gradient-to-r from-transparent via-white/40 to-transparent pointer-events-none skew-x-[-20deg]"></div>
        <span class="relative z-10 flex items-center gap-2">
          Start Building
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </span>
      </a>
      <a href="https://app.aeternaio.com/" target="_blank"
         class="px-6 py-2 rounded-full font-semibold text-sm uppercase tracking-wider border-2 border-white/20 text-white/70 hover:text-white hover:border-white/50 transition-all duration-300">
        Launch App
      </a>
    </div>

    <!-- Mobile hamburger -->
    <button id="menu-toggle" class="md:hidden flex flex-col gap-1.5 p-2 z-50" aria-label="Open menu">
      <span class="w-6 h-0.5 bg-white block"></span>
      <span class="w-6 h-0.5 bg-white block"></span>
      <span class="w-4 h-0.5 bg-white block"></span>
    </button>
  </div>
</header>

<!-- Mobile overlay -->
<div id="mobile-menu" class="fixed inset-0 z-[60] bg-[#0a0a0a] hidden flex-col p-6">
  <div class="flex justify-between items-center mb-10">
    <div class="flex items-center gap-3">
      <img alt="Aeterna Logo" class="h-7 w-auto" src="/site-assets/logo-wite.svg">
      <span class="text-xl font-bold tracking-tighter text-[#EBFF00]">AETERNA</span>
    </div>
    <button id="menu-close" class="p-2 text-white/60 hover:text-white">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>

  <nav class="flex flex-col gap-1 overflow-y-auto flex-1">
    @foreach($navItems as $item)
      <a href="{{ $item->url }}" class="text-base font-bold uppercase tracking-wider text-white/70 py-3.5 border-b border-white/5 hover:text-[#EBFF00] transition">
        {{ $item->label }}
      </a>
      @if($item->children->count())
        <div class="pl-4 flex flex-col gap-1 pb-2">
          @foreach($item->children as $child)
            <a href="{{ $child->url }}" class="text-sm text-neutral-500 py-2 hover:text-[#EBFF00] transition">
              {{ $child->label }}
            </a>
          @endforeach
        </div>
      @endif
    @endforeach
  </nav>

  <div class="mt-6 flex flex-col gap-3">
    <a href="#" class="text-center py-3 rounded-full border-2 border-[#EBFF00] bg-[#EBFF00] text-black font-bold uppercase tracking-wider text-sm">Start Building</a>
    <a href="https://app.aeternaio.com/" target="_blank" class="text-center py-3 rounded-full border-2 border-white/20 text-white font-semibold uppercase tracking-wider text-sm">Launch App</a>
  </div>
</div>
