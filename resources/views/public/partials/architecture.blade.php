<section id="architecture" class="pt-24 px-6" style="background:#F5F4F0">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-14" data-animate>
      <div class="section-label">Architecture</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">Built Different. Built to Last.</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:#454745">A 4-layer architecture designed for the AI-native, chain-abstracted future of the internet.</p>
    </div>

    <!-- Layer tabs -->
    <div class="flex flex-wrap justify-center gap-2 mb-12" data-animate>
      @foreach($layers as $layer)
        <button data-arch-tab="{{ $layer->slug }}"
          class="px-5 py-2.5 text-sm font-semibold transition-all duration-200"
          style="border-radius:999px;border:1.5px solid #D6D6D6;background:#EEECEA;color:#454745">
          L{{ $layer->layer_number }} {{ $layer->name }}
        </button>
      @endforeach
    </div>

    <!-- Panels -->
    @foreach($layers as $layer)
    <div id="{{ $layer->slug }}" data-arch-panel="{{ $layer->slug }}" class="hidden">
      <div class="grid lg:grid-cols-2 gap-8 items-start">
        <!-- Left: info card -->
        <div class="card-spotlight p-8 transition-all duration-300 hover:shadow-lg"
             style="background:#FFFFFF;border:1px solid #D6D6D6;border-radius:16px">
          <div class="flex items-center gap-4 mb-5">
            <div class="w-12 h-12 flex items-center justify-center flex-shrink-0"
                 style="background:rgba(159,232,112,0.15);border:1.5px solid rgba(159,232,112,0.45);border-radius:16px;color:#1A1A1A">
              {!! $layer->icon_svg !!}
            </div>
            <div>
              <div class="text-xs font-bold mb-1" style="color:#EBFF00;background:#0D0D0D;display:inline-block;padding:2px 10px;border-radius:999px;letter-spacing:0.06em">LAYER {{ $layer->layer_number }}</div>
              <h3 class="text-xl font-bold" style="color:#1A1A1A;letter-spacing:-0.02em">{{ $layer->name }}</h3>
            </div>
          </div>
          <p style="color:#454745;line-height:1.65">{{ $layer->description }}</p>
        </div>

        <!-- Right: features grid -->
        <div class="grid sm:grid-cols-2 gap-4">
          @foreach($layer->features_json ?? [] as $i => $feature)
          <div class="card-spotlight p-5 transition-all duration-200 group" data-animate style="animation-delay:{{ $i * 0.05 }}s;background:#FFFFFF;border:1px solid #D6D6D6;border-radius:16px">
            <div class="w-5 h-5 mb-3" style="color:#1A1A1A">{!! $feature['icon_svg'] !!}</div>
            <h4 class="font-semibold mb-1.5 text-sm" style="color:#1A1A1A">{{ $feature['title'] }}</h4>
            <p class="text-xs leading-relaxed" style="color:#454745">{{ $feature['description'] }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endforeach

    <!-- Stack diagram -->
    <!-- <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-4 overflow-hidden" style="border:1px solid #D6D6D6;border-radius:16px;gap:1px;background:#D6D6D6" data-animate>
      @foreach($layers->sortBy('layer_number') as $i => $layer)
      <div class="group relative flex flex-col overflow-hidden transition-all duration-300 card-spotlight"
           style="background:#FFFFFF">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"
             style="background:linear-gradient(135deg,rgba(159,232,112,0.10) 0%,transparent 60%)"></div>
        <div class="p-7 flex flex-col h-full relative z-10">
          <div class="flex justify-between items-start mb-5">
            <div class="w-11 h-11 flex items-center justify-center transition-all duration-300 group-hover:scale-110 shrink-0"
                 style="background:#F5F4F0;border:1.5px solid #D6D6D6;border-radius:12px;color:#1A1A1A">
              {!! $layer->icon_svg !!}
            </div>
            <span class="font-mono text-[10px] uppercase tracking-widest" style="color:#D6D6D6">L0{{ $layer->layer_number }}</span>
          </div>
          <h4 class="font-bold text-sm mb-2 transition-colors duration-300" style="color:#1A1A1A;letter-spacing:-0.01em">{{ $layer->name }}</h4>
          <p class="text-xs leading-relaxed line-clamp-3" style="color:#868685">{{ $layer->description }}</p>
        </div>
      </div>
      @endforeach
    </div> -->
  </div>
</section>
