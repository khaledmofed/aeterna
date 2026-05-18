<section class="py-10 overflow-hidden border-y border-white/5 bg-[#0a0a0a]">
  @php
  $items = ['Ethereum','Solana','Bitcoin','BNB Chain','Arbitrum','Polygon','Avalanche','Optimism','Base','Cosmos','Polkadot','Near','Aptos','Sui','Fantom'];
  $doubled = array_merge($items, $items);
  @endphp

  <!-- Row 1 — scroll left -->
  <div class="flex whitespace-nowrap mb-4">
    <div class="flex gap-8 animate-scroll-left">
      @foreach($doubled as $chain)
        <div class="flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/3 text-white/50 text-sm font-medium flex-shrink-0">
          <span class="w-1.5 h-1.5 rounded-full bg-[#EBFF00]/50"></span>
          {{ $chain }}
        </div>
      @endforeach
    </div>
  </div>

  <!-- Row 2 — scroll right -->
  <div class="flex whitespace-nowrap">
    <div class="flex gap-8 animate-scroll-right">
      @foreach(array_reverse($doubled) as $chain)
        <div class="flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/3 text-white/40 text-sm font-medium flex-shrink-0">
          <span class="w-1.5 h-1.5 rounded-full bg-white/20"></span>
          {{ $chain }}
        </div>
      @endforeach
    </div>
  </div>
</section>
