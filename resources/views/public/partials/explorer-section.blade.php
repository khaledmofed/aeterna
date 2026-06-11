<section id="explorer" class="py-24 px-6" style="background:#0D0D0D;position:relative;overflow:hidden">
  <!-- Grid background pattern -->
  <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:40px 40px;"></div>

  <div class="max-w-7xl mx-auto relative z-10">
    <!-- Header -->
    <div class="text-center mb-16" data-animate>
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-6" style="background:rgba(235,255,0,0.1);border:1px solid rgba(235,255,0,0.2)">
        <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background:#EBFF00"></span>
        <span class="text-xs font-bold tracking-widest uppercase" style="color:#EBFF00">Block Explorer</span>
      </div>
      <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4" style="color:#FFFFFF;letter-spacing:-0.03em;line-height:1.05">
        The AI-native L1,<br><span style="color:#EBFF00">made visible</span>
      </h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:rgba(255,255,255,0.5)">
        Explore blocks, transactions, AI agents, cross-chain accounts, and skill markets on the Aeterna chain.
      </p>
    </div>

    <!-- 8 cards grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4" data-animate>
      @foreach($explorerPages as $ep)
      <a href="{{ route('explorer.show', $ep->slug) }}"
         class="group flex flex-col p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1"
         style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08)">
        <!-- Icon + number -->
        <div class="flex items-start justify-between mb-4">
          <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(235,255,0,0.1);border:1px solid rgba(235,255,0,0.2);color:#EBFF00">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">{!! $ep->icon_svg !!}</svg>
          </div>
          <span class="font-mono text-xs" style="color:rgba(255,255,255,0.2)">{{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}</span>
        </div>
        <!-- Title + desc -->
        <h3 class="font-bold text-lg mb-2 group-hover:text-[#EBFF00] transition-colors" style="color:#FFFFFF;letter-spacing:-0.02em">{{ $ep->title }}</h3>
        <p class="text-sm leading-relaxed flex-1 mb-4" style="color:rgba(255,255,255,0.45)">{{ $ep->description }}</p>
        <!-- Tag -->
        <div class="self-start">
          <span class="text-xs font-bold px-3 py-1 rounded-full" style="background:rgba(235,255,0,0.1);border:1px solid rgba(235,255,0,0.2);color:#EBFF00">{{ $ep->tag }}</span>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
