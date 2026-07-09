<section id="investors" class="py-24 px-6" style="background:#EEECEA">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="section-label mb-4">{{ __('messages.investors.badge') }}</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">{{ __('messages.investors.title') }}</h2>
      <p class="text-lg" style="color:#454745">{{ __('messages.investors.subtitle') }}</p>
    </div>

    <!-- Lead investors (top 3 by Order) -->
    @php $leads = $investors->take(3); $strategic = $investors->skip(3)->values(); @endphp
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
          <img src="{{ $leadLogoSrc }}" alt="{{ $inv->name }}" class="investor-logo h-10 object-contain mb-3" onerror="this.style.display='none'">
        @endif
        <span class="font-semibold text-sm text-center investor-name" style="color:#1A1A1A">{{ $inv->name }}</span>
      </a>
      @endforeach
    </div>

    <!-- Strategic partners (rest, sliding) -->
    @if($strategic->isNotEmpty())
    <div class="overflow-hidden" data-animate>
      <div class="flex gap-3 animate-scroll-left" style="width:max-content">
        @foreach($strategic->concat($strategic) as $inv)
        @php
          $domain   = parse_url($inv->website_url ?? '', PHP_URL_HOST);
          $domain   = $domain ? preg_replace('/^www\./', '', $domain) : null;
          $logoSrc  = $inv->logo_url
                        ?: ($domain ? 'https://logo.clearbit.com/' . $domain : null);
        @endphp
        <a href="{{ $inv->website_url ?? '#' }}" target="_blank"
          class="group flex flex-col items-center justify-center gap-2 p-3 rounded-xl transition-all duration-300 hover:shadow-md hover:border-[#9FE870]/60 flex-shrink-0"
          style="background:#FFFFFF;border:1px solid #D6D6D6;width:130px;aspect-ratio:1;{{ $inv->glow_color ? 'box-shadow:0 0 16px '.$inv->glow_color.'10 inset' : '' }}">
          @if($logoSrc)
            <img src="{{ $logoSrc }}"
                 alt="{{ $inv->name }}"
                 class="investor-logo h-6 w-auto object-contain transition-all duration-300 group-hover:scale-105"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
            <div class="w-2.5 h-2.5 rounded-full" style="background:{{ $inv->glow_color ?? '#D6D6D6' }};display:none"></div>
          @else
            <div class="w-2.5 h-2.5 rounded-full" style="background:{{ $inv->glow_color ?? '#D6D6D6' }}"></div>
          @endif
          <span class="investor-name font-medium leading-tight text-center" style="font-size:10px;color:#454745">{{ $inv->name }}</span>
        </a>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>
