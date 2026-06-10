<section id="exchange" class="py-24 px-6" style="background:#F5F4F0">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="section-label mb-4">Exchange</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">The Most Powerful<br>Decentralized Exchange</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:#454745">AI-powered, cross-chain, privacy-preserving DEX built on Aeterna's L1 ; the fastest on-chain trading experience.</p>
    </div>

    <!-- Feature cards -->
    @php
    $features = [
      [
        'title' => 'High-Frequency Trading',
        'desc'  => 'Sub-100ms execution with 160K+ TPS throughput ; institutional-grade performance for every trader.',
        'icon'  => '<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>',
      ],
      [
        'title' => 'Cross-Chain Liquidity',
        'desc'  => 'Unified liquidity from 15+ chains in a single pool ; no bridging, no slippage surprises.',
        'icon'  => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
      ],
      [
        'title' => 'AI Market Making',
        'desc'  => 'On-chain AI agents provide deep liquidity 24/7, tightening spreads and reducing impermanent loss.',
        'icon'  => '<path d="M12 18V5"/><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"/><path d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 1 0-5.598 1.5"/><path d="M17.997 5.125a4 4 0 0 1 2.526 5.77"/><path d="M18 18a4 4 0 0 0 2-7.464"/><path d="M19.967 17.483A4 4 0 1 1 12 18a4 4 0 1 1-7.967-.517"/><path d="M6 18a4 4 0 0 1-2-7.464"/><path d="M6.003 5.125a4 4 0 0 0-2.526 5.77"/>',
      ],
      [
        'title' => 'Private Trading',
        'desc'  => 'Optional RingCT + ZK-proof privacy ; trade confidentially without revealing position sizes.',
        'icon'  => '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/>',
      ],
      [
        'title' => 'Gas-Free Trading',
        'desc'  => 'Trade with zero gas fees using resource credits from AETHER staking.',
        'icon'  => '<path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>',
      ],
      [
        'title' => 'Advanced Order Types',
        'desc'  => 'Limit orders, stop-loss, TWAP, and AI-optimized conditional orders ; all executed on-chain.',
        'icon'  => '<path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/>',
      ],
    ];
    @endphp

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 overflow-hidden mb-16" style="border:1px solid #D6D6D6;border-radius:16px;gap:1px;background:#D6D6D6">
      @foreach($features as $i => $f)
      <div class="animate-fade-in-up" style="animation-delay:{{ $i * 50 }}ms" data-animate>
        <div class="group relative flex flex-col h-full overflow-hidden transition-all duration-500 card-spotlight" style="background:#FFFFFF">
          <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" style="background:linear-gradient(135deg,rgba(159,232,112,0.10) 0%,transparent 60%)"></div>

          <div class="p-8 flex flex-col h-full relative z-10">
            <div class="flex justify-between items-start mb-6">
              <div class="w-12 h-12 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:bg-[#9FE870] shrink-0"
                   style="background:#F5F4F0;border:1.5px solid #D0D0CA;color:#1A1A1A">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $f['icon'] !!}</svg>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="opacity-0 group-hover:opacity-100 transition-all translate-y-2 group-hover:translate-y-0" style="color:#D6D6D6" aria-hidden="true">
                <path d="M7 7h10v10"/><path d="M7 17 17 7"/>
              </svg>
            </div>

            <h3 class="text-xl font-bold mb-3 transition-colors duration-300" style="color:#1A1A1A">{{ $f['title'] }}</h3>
            <p class="text-sm leading-relaxed" style="color:#454745">{{ $f['desc'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Intent demo -->
    <div class="rounded-2xl p-8" style="background:#FFFFFF;border:1px solid #D6D6D6" data-animate>
      <h3 class="text-xl font-bold mb-6" style="color:#1A1A1A">See Chain Abstraction in Action</h3>
      <div class="grid lg:grid-cols-2 gap-8 items-center">
        <div style="overflow:auto">
          <pre class="rounded-xl overflow-auto text-sm" style="background:#1A1A1A"><code class="language-typescript">// Aeterna Intent SDK
const intent = await aeterna.createIntent({
  from: { chain: 'arbitrum', token: 'USDC', amount: 1000 },
  to:   { chain: 'solana',   token: 'SOL' },
  maxSlippage: 0.5, // %
  deadline: 60,     // seconds
});

// Solver network finds best route
const result = await intent.execute();
// → Swapped 1000 USDC (Arb) → ~15 SOL (Solana)
// → Route: Arb → Aeterna → Solana (47ms)</code></pre>
        </div>
        <div class="flex flex-col gap-3">
          @php $steps = [
            ['n'=>'01','label'=>'Intent submitted','desc'=>'User declares desired outcome on Aeterna'],
            ['n'=>'02','label'=>'Solver auction','desc'=>'On-chain Dutch auction ; solvers compete for best route'],
            ['n'=>'03','label'=>'Cross-chain bridging','desc'=>'Universal Address handles multi-chain transfer'],
            ['n'=>'04','label'=>'Settlement','desc'=>'Funds delivered in <100ms, proof stored on-chain'],
          ]; @endphp
          @foreach($steps as $step)
          <div class="flex items-start gap-4 p-4 rounded-xl" style="background:#F5F4F0;border:1px solid #D6D6D6">
            <span class="font-mono text-sm font-bold flex-shrink-0" style="color:#9FE870">{{ $step['n'] }}</span>
            <div>
              <div class="font-semibold text-sm" style="color:#1A1A1A">{{ $step['label'] }}</div>
              <div class="text-xs mt-0.5" style="color:#454745">{{ $step['desc'] }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
