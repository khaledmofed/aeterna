<section id="use-cases" class="py-24 px-6" style="background:#F5F4F0">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="section-label mb-4">Use Cases</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">RWA Infrastructure &<br>Open UBI Vision</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:#454745">Real-world value for real-world people — powered by Aeterna's AI-native, chain-abstracted infrastructure.</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
      @foreach($useCases as $i => $case)
      <div class="card-beam card-spotlight rounded-3xl p-8 transition-all duration-300 hover:shadow-lg" data-animate style="animation-delay:{{ $i * 0.1 }}s;background:#FFFFFF;border:1px solid #D6D6D6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background:rgba(159,232,112,0.15);border:1.5px solid rgba(159,232,112,0.45);color:#1A1A1A">
          {!! $case->icon_svg !!}
        </div>
        <h3 class="text-2xl font-bold mb-3" style="color:#1A1A1A;letter-spacing:-0.02em">{{ $case->title }}</h3>
        <p class="leading-relaxed mb-6" style="color:#454745">{{ $case->description }}</p>

        @if($case->features_json)
        <div class="grid grid-cols-2 gap-3">
          @foreach($case->features_json as $feature)
          <div class="flex items-start gap-2">
            <span class="w-1.5 h-1.5 rounded-full mt-2 flex-shrink-0" style="background:#9FE870"></span>
            <div>
              <div class="text-xs font-semibold mb-0.5" style="color:#1A1A1A">{{ $feature['title'] }}</div>
              <div class="text-xs leading-relaxed" style="color:#454745">{{ $feature['description'] }}</div>
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
