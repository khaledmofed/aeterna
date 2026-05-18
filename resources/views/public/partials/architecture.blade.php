<section id="architecture" class="py-24 px-6 bg-[#0a0a0a]">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/3 text-white/60 text-sm mb-4">Architecture</div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Built Different. Built to Last.</h2>
      <p class="text-white/50 text-lg max-w-2xl mx-auto">A 4-layer architecture designed for the AI-native, chain-abstracted future of the internet.</p>
    </div>

    <!-- Layer tabs -->
    <div class="flex flex-wrap justify-center gap-2 mb-12" data-animate>
      @foreach($layers as $layer)
        <button data-arch-tab="{{ $layer->slug }}"
          class="px-5 py-2.5 rounded-full border border-white/15 text-white/60 text-sm font-medium hover:text-white hover:border-white/30 transition">
          L{{ $layer->layer_number }} {{ $layer->name }}
        </button>
      @endforeach
    </div>

    <!-- Panels -->
    @foreach($layers as $layer)
    <div id="{{ $layer->slug }}" data-arch-panel="{{ $layer->slug }}" class="hidden">
      <div class="grid lg:grid-cols-2 gap-8 items-start">
        <!-- Left: info -->
        <div class="card-beam card-spotlight bg-[#111] border border-white/10 rounded-2xl p-8 hover:border-[#EBFF00]/30 transition-colors">
          <div class="flex items-center gap-4 mb-5">
            <div class="w-12 h-12 rounded-xl bg-[#EBFF00]/10 border border-[#EBFF00]/20 flex items-center justify-center text-[#EBFF00]">
              {!! $layer->icon_svg !!}
            </div>
            <div>
              <div class="text-xs text-[#EBFF00] font-mono mb-1">LAYER {{ $layer->layer_number }}</div>
              <h3 class="text-xl font-bold text-white">{{ $layer->name }}</h3>
            </div>
          </div>
          <p class="text-white/60 leading-relaxed">{{ $layer->description }}</p>
        </div>

        <!-- Right: features grid -->
        <div class="grid sm:grid-cols-2 gap-4">
          @foreach($layer->features_json ?? [] as $i => $feature)
          <div class="card-spotlight bg-[#111] border border-white/8 rounded-xl p-5 hover:border-[#EBFF00]/20 hover:bg-[#EBFF00]/2 transition-all" data-animate style="animation-delay:{{ $i * 0.05 }}s">
            <div class="w-5 h-5 text-[#EBFF00] mb-3">{!! $feature['icon_svg'] !!}</div>
            <h4 class="text-white font-semibold mb-1.5 text-sm">{{ $feature['title'] }}</h4>
            <p class="text-white/45 text-xs leading-relaxed">{{ $feature['description'] }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endforeach

    <!-- Stack diagram -->
    <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-4 gap-px bg-white/10 border border-white/10 overflow-hidden rounded-2xl" data-animate>
      @foreach($layers->sortBy('layer_number') as $i => $layer)
      <div class="group relative flex flex-col bg-[#0a0a0a] border border-white/10 hover:border-[#EBFF00]/50 transition-all duration-500 overflow-hidden card-spotlight">
        <div class="absolute inset-0 bg-gradient-to-br from-[#EBFF00]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
        <div class="p-7 flex flex-col h-full relative z-10">
          <div class="flex justify-between items-start mb-5">
            <div class="w-11 h-11 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-[#EBFF00] group-hover:scale-110 group-hover:bg-[#EBFF00] group-hover:text-black transition-all duration-300 shrink-0">
              {!! $layer->icon_svg !!}
            </div>
            <span class="font-mono text-[10px] uppercase tracking-widest text-neutral-600 group-hover:text-[#EBFF00] transition-colors">L0{{ $layer->layer_number }}</span>
          </div>
          <h4 class="font-bold text-white text-sm mb-2 group-hover:text-[#EBFF00] transition-colors duration-300">{{ $layer->name }}</h4>
          <p class="text-neutral-600 text-xs leading-relaxed group-hover:text-neutral-400 transition-colors line-clamp-3">{{ $layer->description }}</p>
        </div>
        <div class="absolute -bottom-6 -right-6 opacity-0 group-hover:opacity-[0.03] transition-opacity duration-500 pointer-events-none">
          <div class="w-32 h-32 text-white">{!! $layer->icon_svg !!}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
