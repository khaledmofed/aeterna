<section id="architecture" class="py-24 px-6" style="background:#F5F4F0">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-14" data-animate>
      <div class="section-label">{{ __('messages.architecture.badge') }}</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">{{ __('messages.architecture.title') }}</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:#454745">{{ __('messages.architecture.subtitle') }}</p>
    </div>

    <!-- Layer tabs -->
    <div class="flex flex-wrap justify-center gap-2 mb-12" data-animate>
      @foreach($layers as $layer)
        <button data-arch-tab="{{ $layer->slug }}"
          class="px-5 py-2.5 text-sm font-semibold transition-all duration-200"
          style="border-radius:999px;border:1.5px solid #D6D6D6;background:#EEECEA;color:#454745">
          {{ __('messages.architecture.layer') }}{{ $layer->layer_number }} {{ $layer->name }}
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
              <div class="text-xs font-bold mb-1" style="color:#EBFF00;background:#0D0D0D;display:inline-block;padding:2px 10px;border-radius:999px;letter-spacing:0.06em">{{ __('messages.architecture.layer') }} {{ $layer->layer_number }}</div>
              <h3 class="text-xl font-bold" style="color:#1A1A1A;letter-spacing:-0.02em">{{ $layer->name }}</h3>
            </div>
          </div>
          <p style="color:#454745;line-height:1.65">{{ $layer->description }}</p>
        </div>

        <!-- Right: features grid -->
        <div class="grid sm:grid-cols-2 gap-4">
          @foreach(json_decode($layer->features_json ?? '[]', true) ?? [] as $i => $feature)
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
  </div>
</section>
