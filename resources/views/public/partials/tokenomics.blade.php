<section id="tokenomics" class="py-24 px-6 bg-[#111]">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#EBFF00]/20 bg-[#EBFF00]/5 text-[#EBFF00] text-sm mb-4">{{ $tokenomics->section_badge ?? 'Token Economics' }}</div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $tokenomics->section_title ?? 'AETHER Tokenomics' }}</h2>
      <p class="text-white/50 text-lg max-w-2xl mx-auto">{{ $tokenomics->section_subtitle ?? '' }}</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 mb-12">
      <!-- Token card -->
      <div class="bg-[#0a0a0a] border border-white/10 rounded-2xl p-8" data-animate>
        <div class="flex justify-between items-start mb-6">
          <div>
            <h3 class="text-3xl font-bold text-white">{{ $tokenomics->token_name ?? 'AETHER' }}</h3>
            <div class="text-[#EBFF00] font-mono text-sm mt-1">{{ $tokenomics->token_ticker ?? 'ATA' }}</div>
          </div>
          <div class="text-right">
            <div class="text-xs text-white/40 mb-1">Total Supply</div>
            <div class="text-lg font-bold text-white">{{ $tokenomics->token_supply ?? '1,000,000,000 ATA' }}</div>
          </div>
        </div>
        <!-- Allocation chart -->
        <div class="flex items-center gap-8">
          <div class="relative w-40 h-40 flex-shrink-0">
            <canvas id="tokenChart"></canvas>
          </div>
          <div class="flex flex-col gap-2 flex-1">
            @foreach($tokenomics->allocation_json ?? [] as $alloc)
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $alloc['color'] }}"></span>
                <span class="text-xs text-white/60">{{ $alloc['label'] }}</span>
              </div>
              <span class="text-xs font-bold text-white">{{ $alloc['percentage'] }}%</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Stats grid -->
      <div class="grid grid-cols-2 gap-4" data-animate>
        @foreach($tokenomics->stats_json ?? [] as $stat)
        <div class="bg-[#0a0a0a] border border-white/10 rounded-xl p-6 hover:border-[#EBFF00]/20 transition">
          <div class="text-2xl font-bold text-[#EBFF00] mb-1">{{ $stat['value'] }}</div>
          <div class="text-sm text-white font-medium mb-1">{{ $stat['label'] }}</div>
          <div class="text-xs text-white/40">{{ $stat['description'] ?? '' }}</div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Flywheel -->
    <div class="bg-[#0a0a0a] border border-white/10 rounded-2xl p-8 mb-12" data-animate>
      <h3 class="text-xl font-bold text-white mb-6 text-center">Economic Flywheel</h3>
      <div class="flex flex-wrap justify-center items-center gap-2">
        @foreach($tokenomics->flywheel_steps_json ?? [] as $i => $step)
          <div class="flex items-center gap-2">
            <div class="px-3 py-2 rounded-lg bg-[#EBFF00]/10 border border-[#EBFF00]/20 text-[#EBFF00] text-xs font-medium text-center">{{ $step }}</div>
            @if(!$loop->last)
              <svg class="w-4 h-4 text-white/30 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @endif
          </div>
        @endforeach
      </div>
    </div>

    <!-- Mechanics -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-px bg-white/10 border border-white/10 overflow-hidden rounded-2xl mb-12">
      @foreach($tokenomics->mechanics_json ?? [] as $i => $mech)
      <div class="group relative flex flex-col bg-[#0a0a0a] border border-white/10 hover:border-[#EBFF00]/50 transition-all duration-500 overflow-hidden card-spotlight" data-animate style="animation-delay:{{ $i * 50 }}ms">
        <div class="absolute inset-0 bg-gradient-to-br from-[#EBFF00]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
        <div class="p-7 flex flex-col h-full relative z-10">
          <div class="flex justify-between items-start mb-5">
            <div class="w-11 h-11 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-[#EBFF00] group-hover:scale-110 group-hover:bg-[#EBFF00] group-hover:text-black transition-all duration-300 shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $mech['icon_svg'] !!}</svg>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="text-neutral-700 group-hover:text-[#EBFF00] opacity-0 group-hover:opacity-100 transition-all translate-y-2 group-hover:translate-y-0" aria-hidden="true">
              <path d="M7 7h10v10"/><path d="M7 17 17 7"/>
            </svg>
          </div>
          <h4 class="font-bold text-white mb-2 text-sm group-hover:text-[#EBFF00] transition-colors duration-300">{{ $mech['title'] }}</h4>
          <p class="text-neutral-500 text-xs leading-relaxed group-hover:text-neutral-400 transition-colors">{{ $mech['description'] }}</p>
        </div>
        <div class="absolute -bottom-6 -right-6 opacity-0 group-hover:opacity-[0.03] transition-opacity duration-500 pointer-events-none">
          <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $mech['icon_svg'] !!}</svg>
        </div>
      </div>
      @endforeach
    </div>

    <!-- AIA Token card -->
    <div class="bg-gradient-to-r from-[#EBFF00]/5 to-transparent border border-[#EBFF00]/20 rounded-2xl p-8" data-animate>
      <div class="flex items-start gap-6">
        <div class="w-14 h-14 rounded-xl bg-[#EBFF00]/15 border border-[#EBFF00]/30 flex items-center justify-center text-[#EBFF00] font-bold text-lg flex-shrink-0">AIA</div>
        <div>
          <h3 class="text-xl font-bold text-white mb-2">{{ $tokenomics->lp_token_name ?? 'AIA' }} — Liquidity Provider Token</h3>
          <p class="text-white/60 leading-relaxed">{{ $tokenomics->lp_token_description ?? '' }}</p>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const ctx = document.getElementById('tokenChart');
  if (!ctx) return;
  const data = @json($tokenomics->allocation_json ?? []);
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: data.map(d => d.label),
      datasets: [{ data: data.map(d => d.percentage), backgroundColor: data.map(d => d.color), borderWidth: 0, hoverOffset: 4 }]
    },
    options: { cutout: '70%', plugins: { legend: { display: false } }, responsive: true }
  });
});
</script>
@endpush
