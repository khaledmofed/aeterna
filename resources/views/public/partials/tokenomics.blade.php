<section id="tokenomics" class="py-24 px-6" style="background:#EEECEA">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="section-label mb-4">{{ $tokenomics->section_badge ?? 'Token Economics' }}</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">{{ $tokenomics->section_title ?? 'AETHER Tokenomics' }}</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:#454745">{{ $tokenomics->section_subtitle ?? '' }}</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 mb-12">
      <!-- Token card — stays dark for contrast -->
      <div class="rounded-3xl p-8" style="background:#1A1A1A;border:1px solid #2A2A2A" data-animate>
        <div class="flex justify-between items-start mb-6">
          <div>
            <h3 class="text-3xl font-black" style="color:#FFFFFF;letter-spacing:-0.03em">{{ $tokenomics->token_name ?? 'AETHER' }}</h3>
            <div class="font-mono text-sm mt-1" style="color:#EBFF00">{{ $tokenomics->token_ticker ?? 'ATA' }}</div>
          </div>
          <div class="text-right">
            <div class="text-xs mb-1" style="color:rgba(255,255,255,0.4)">Total Supply</div>
            <div class="text-lg font-bold" style="color:#FFFFFF">{{ $tokenomics->token_supply ?? '1,000,000,000 ATA' }}</div>
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
                <span class="text-xs" style="color:rgba(255,255,255,0.6)">{{ $alloc['label'] }}</span>
              </div>
              <span class="text-xs font-bold" style="color:#FFFFFF">{{ $alloc['percentage'] }}%</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Stats grid — light cards -->
      <div class="grid grid-cols-2 gap-4" data-animate>
        @foreach($tokenomics->stats_json ?? [] as $stat)
        <div class="rounded-xl p-6 transition-all" style="background:#FFFFFF;border:1px solid #D6D6D6;border-radius:16px">
          <div class="text-2xl font-black mb-1" style="color:#1A1A1A;letter-spacing:-0.02em">{{ $stat['value'] }}</div>
          <div class="text-sm font-semibold mb-1" style="color:#1A1A1A">{{ $stat['label'] }}</div>
          <div class="text-xs" style="color:#454745">{{ $stat['description'] ?? '' }}</div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Flywheel -->
    <div class="rounded-3xl p-8 mb-12" style="background:#FFFFFF;border:1px solid #D6D6D6" data-animate>
      <h3 class="text-xl font-bold mb-6 text-center" style="color:#1A1A1A;letter-spacing:-0.02em">Economic Flywheel</h3>
      <div class="flex flex-wrap justify-center items-center gap-2">
        @foreach($tokenomics->flywheel_steps_json ?? [] as $i => $step)
          <div class="flex items-center gap-2">
            <div class="px-4 py-2 rounded-full text-xs font-semibold text-center" style="background:rgba(159,232,112,0.18);border:1px solid rgba(159,232,112,0.5);color:#1A1A1A;letter-spacing:0.01em">{{ $step }}</div>
            @if(!$loop->last)
              <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#D6D6D6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @endif
          </div>
        @endforeach
      </div>
    </div>

    <!-- Mechanics -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 overflow-hidden mb-12" style="border:1px solid #D6D6D6;border-radius:16px;gap:1px;background:#D6D6D6">
      @foreach($tokenomics->mechanics_json ?? [] as $i => $mech)
      <div class="group relative flex flex-col overflow-hidden transition-all duration-500 card-spotlight" style="background:#FFFFFF" data-animate style="animation-delay:{{ $i * 50 }}ms">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" style="background:linear-gradient(135deg,rgba(235,255,0,0.08) 0%,transparent 60%)"></div>
        <div class="p-7 flex flex-col h-full relative z-10">
          <div class="flex justify-between items-start mb-5">
            <div class="w-11 h-11 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:bg-[#9FE870] shrink-0"
                 style="background:#F5F4F0;border:1.5px solid #D0D0CA;color:#1A1A1A">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $mech['icon_svg'] !!}</svg>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="opacity-0 group-hover:opacity-100 transition-all translate-y-2 group-hover:translate-y-0" style="color:#D6D6D6" aria-hidden="true">
              <path d="M7 7h10v10"/><path d="M7 17 17 7"/>
            </svg>
          </div>
          <h4 class="font-bold mb-2 text-sm transition-colors duration-300" style="color:#1A1A1A">{{ $mech['title'] }}</h4>
          <p class="text-xs leading-relaxed" style="color:#454745">{{ $mech['description'] }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- AIA Token card — stays dark for contrast -->
    <div class="rounded-3xl p-8" style="background:#1A1A1A;border:1px solid rgba(235,255,0,0.2)" data-animate>
      <div class="flex items-start gap-6">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0" style="background:rgba(235,255,0,0.15);border:1.5px solid rgba(235,255,0,0.4);color:#EBFF00">AIA</div>
        <div>
          <h3 class="text-xl font-bold mb-2" style="color:#FFFFFF">{{ $tokenomics->lp_token_name ?? 'AIA' }} — Liquidity Provider Token</h3>
          <p style="color:rgba(255,255,255,0.6);line-height:1.6">{{ $tokenomics->lp_token_description ?? '' }}</p>
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
