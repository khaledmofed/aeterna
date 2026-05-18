<section id="investors" class="py-24 px-6 bg-[#111]">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/3 text-white/60 text-sm mb-4">Investors</div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Backed by the Best</h2>
      <p class="text-white/50 text-lg">World-class investors and partners accelerating the Aeterna ecosystem.</p>
    </div>

    <!-- Lead investors -->
    @php $leads = $investors->where('type','lead'); $strategic = $investors->where('type','strategic'); @endphp
    <div class="flex flex-wrap justify-center gap-5 mb-10">
      @foreach($leads as $inv)
      <a href="{{ $inv->website_url ?? '#' }}" target="_blank"
        class="flex flex-col items-center justify-center p-8 rounded-2xl bg-[#0a0a0a] border border-white/10 hover:border-white/25 transition w-48 h-36"
        style="{{ $inv->glow_color ? 'box-shadow:0 0 30px '.$inv->glow_color.'15 inset' : '' }}" data-animate>
        @if($inv->logo_url)
          <img src="{{ $inv->logo_url }}" alt="{{ $inv->name }}" class="h-10 object-contain mb-3" onerror="this.style.display='none'">
        @endif
        <span class="text-white font-semibold text-sm text-center">{{ $inv->name }}</span>
      </a>
      @endforeach
    </div>

    <!-- Strategic partners -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
      @foreach($strategic as $inv)
      <a href="{{ $inv->website_url ?? '#' }}" target="_blank"
        class="flex flex-col items-center justify-center p-5 rounded-xl bg-[#0a0a0a] border border-white/10 hover:border-white/25 transition aspect-square"
        style="{{ $inv->glow_color ? 'box-shadow:0 0 20px '.$inv->glow_color.'20 inset' : '' }}" data-animate>
        <div class="w-3 h-3 rounded-full mb-3" style="background:{{ $inv->glow_color ?? '#fff' }}"></div>
        <span class="text-white/70 font-medium text-xs text-center">{{ $inv->name }}</span>
      </a>
      @endforeach
    </div>
  </div>
</section>
