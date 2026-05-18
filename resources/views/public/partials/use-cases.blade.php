<section id="use-cases" class="py-24 px-6 bg-[#0a0a0a]">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/3 text-white/60 text-sm mb-4">Use Cases</div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">RWA Infrastructure &<br>Open UBI Vision</h2>
      <p class="text-white/50 text-lg max-w-2xl mx-auto">Real-world value for real-world people — powered by Aeterna's AI-native, chain-abstracted infrastructure.</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
      @foreach($useCases as $i => $case)
      <div class="card-beam card-spotlight bg-[#111] border border-white/10 rounded-2xl p-8 hover:border-[#EBFF00]/25 transition-all" data-animate style="animation-delay:{{ $i * 0.1 }}s">
        <div class="w-14 h-14 rounded-xl bg-[#EBFF00]/10 border border-[#EBFF00]/20 flex items-center justify-center text-[#EBFF00] mb-6">
          {!! $case->icon_svg !!}
        </div>
        <h3 class="text-2xl font-bold text-white mb-3">{{ $case->title }}</h3>
        <p class="text-white/55 leading-relaxed mb-6">{{ $case->description }}</p>

        @if($case->features_json)
        <div class="grid grid-cols-2 gap-3">
          @foreach($case->features_json as $feature)
          <div class="flex items-start gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#EBFF00]/60 mt-2 flex-shrink-0"></span>
            <div>
              <div class="text-white text-xs font-semibold mb-0.5">{{ $feature['title'] }}</div>
              <div class="text-white/40 text-xs leading-relaxed">{{ $feature['description'] }}</div>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</section>
