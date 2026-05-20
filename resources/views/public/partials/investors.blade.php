<section id="investors" class="py-24 px-6" style="background:#EEECEA">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="section-label mb-4">Investors</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">Backed by the Best</h2>
      <p class="text-lg" style="color:#454745">World-class investors and partners accelerating the Aeterna ecosystem.</p>
    </div>

    <!-- Lead investors -->
    @php $leads = $investors->where('type','lead'); $strategic = $investors->where('type','strategic'); @endphp
    <div class="flex flex-wrap justify-center gap-5 mb-10">
      @foreach($leads as $inv)
      @php
        $leadDomain  = parse_url($inv->website_url ?? '', PHP_URL_HOST);
        $leadDomain  = $leadDomain ? preg_replace('/^www\./', '', $leadDomain) : null;
        $leadLogoSrc = $inv->logo_url
                         ?: ($leadDomain ? 'https://logo.clearbit.com/' . $leadDomain : null);
      @endphp
      <a href="{{ $inv->website_url ?? '#' }}" target="_blank"
        class="flex flex-col items-center justify-center p-8 rounded-3xl transition-all duration-300 w-48 h-36 hover:shadow-md"
        style="background:#FFFFFF;border:1px solid #D6D6D6;{{ $inv->glow_color ? 'box-shadow:0 0 30px '.$inv->glow_color.'10 inset' : '' }}" data-animate>
        @if($leadLogoSrc)
          <img src="{{ $leadLogoSrc }}" alt="{{ $inv->name }}" class="h-10 object-contain mb-3" onerror="this.style.display='none'">
        @endif
        <span class="font-semibold text-sm text-center" style="color:#1A1A1A">{{ $inv->name }}</span>
      </a>
      @endforeach
    </div>

    <!-- Strategic partners -->
    @php
    $logoMap = [
        'YZI Labs'        => 'https://static.yzilabs.com/yzi-lab/static/images/logo.png',
        'Binance Labs'    => 'https://static.yzilabs.com/yzi-lab/static/images/logo.png',
        'OKX Ventures'    => 'https://www.okx.com/cdn/assets/imgs/221/187957948BD02D97.png',
        'HashKey Capital' => 'https://hashkey.capital/static/images/logo.png',
        'Animoca Brands'  => 'https://cdn.prod.website-files.com/694b47ff8f3088ab9288889c/694b47ff8f3088ab928888ff_logo.svg',
        'Pantera Capital' => 'https://logo.clearbit.com/panteracapital.com',
        'Gate Ventures'   => 'https://logo.clearbit.com/gate.io',
    ];
    @endphp
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
      @foreach($strategic as $inv)
      @php
        $domain   = parse_url($inv->website_url ?? '', PHP_URL_HOST);
        $domain   = $domain ? preg_replace('/^www\./', '', $domain) : null;
        $logoSrc  = $inv->logo_url
                      ?: ($logoMap[$inv->name] ?? null)
                      ?: ($domain ? 'https://logo.clearbit.com/' . $domain : null);
      @endphp
      <a href="{{ $inv->website_url ?? '#' }}" target="_blank"
        class="group flex flex-col items-center justify-center gap-3 p-5 rounded-2xl transition-all duration-300 hover:shadow-md hover:border-[#9FE870]/60"
        style="background:#FFFFFF;border:1px solid #D6D6D6;aspect-ratio:1;{{ $inv->glow_color ? 'box-shadow:0 0 20px '.$inv->glow_color.'10 inset' : '' }}" data-animate>
        @if($logoSrc)
          <img src="{{ $logoSrc }}"
               alt="{{ $inv->name }}"
               class="h-8 w-auto object-contain transition-all duration-300 group-hover:scale-105"
               onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
          <div class="w-3 h-3 rounded-full" style="background:{{ $inv->glow_color ?? '#D6D6D6' }};display:none"></div>
        @else
          <div class="w-3 h-3 rounded-full" style="background:{{ $inv->glow_color ?? '#D6D6D6' }}"></div>
        @endif
        <span class="font-medium text-xs text-center leading-tight" style="color:#454745">{{ $inv->name }}</span>
      </a>
      @endforeach
    </div>
  </div>
</section>
