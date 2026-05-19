<section id="ticker-strip" class="py-10 overflow-hidden" style="background:#1A1A1A;border-top:1px solid #2A2A2A;border-bottom:1px solid #2A2A2A">
  @php
  $items = ['Ethereum','Solana','Bitcoin','BNB Chain','Arbitrum','Polygon','Avalanche','Optimism','Base','Cosmos','Polkadot','Near','Aptos','Sui','Fantom'];
  $doubled = array_merge($items, $items);
  @endphp

  <!-- Row 1 — scroll left -->
  <div class="flex whitespace-nowrap mb-4">
    <div class="flex gap-8 animate-scroll-left">
      @foreach($doubled as $chain)
        <div class="flex items-center gap-2 px-4 py-2 flex-shrink-0"
             style="border-radius:999px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.04);color:rgba(255,255,255,0.6);font-size:0.85rem;font-weight:500">
          <span class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#EBFF00;opacity:0.7"></span>
          {{ $chain }}
        </div>
      @endforeach
    </div>
  </div>

  <!-- Row 2 — scroll right -->
  <div class="flex whitespace-nowrap">
    <div class="flex gap-8 animate-scroll-right">
      @foreach(array_reverse($doubled) as $chain)
        <div class="flex items-center gap-2 px-4 py-2 flex-shrink-0"
             style="border-radius:999px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.03);color:rgba(255,255,255,0.4);font-size:0.85rem;font-weight:500">
          <span class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:rgba(255,255,255,0.2)"></span>
          {{ $chain }}
        </div>
      @endforeach
    </div>
  </div>
</section>
