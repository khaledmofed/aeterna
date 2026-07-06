<section id="hero" class="relative min-h-screen flex flex-col items-center justify-center text-center overflow-hidden px-6 pt-24 pb-16" style="background:#E8E8E3">
  <!-- Canvas particle background -->
  <div id="hero-canvas-wrapper" class="absolute inset-0 w-full h-full pointer-events-none will-change-transform">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <canvas id="hero-canvas" class="block w-full h-full"></canvas>
      <div class="hero-edge-gradient absolute inset-0" style="background:radial-gradient(ellipse 90% 95% at center,transparent 60%,#E8E8E3 88%)"></div>
      <div class="hero-center-mask absolute inset-0" style="background:radial-gradient(ellipse 42% 48% at center,#E8E8E3 55%,transparent 100%)"></div>
    </div>
  </div>

  <div class="relative z-10 max-w-5xl mx-auto">
    <!-- Badge -->
    <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 animate-scale-in"
         style="background:#9FE870;color:#1A1A1A;border-radius:999px;font-size:0.8rem;font-weight:700;letter-spacing:0.02em">
      <span class="w-2 h-2 rounded-full animate-pulse" style="background:#1A1A1A;opacity:0.4"></span>
      {{ $hero->badge_text ?? 'AI Native Layer 1 ; Now Live' }}
    </div>

    <!-- Headline -->
    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-6 animate-hero-title"
        style="color:#1A1A1A;letter-spacing:-0.03em;line-height:1.04">
      {!! nl2br(e($hero->headline ?? 'The Future is Chainless.')) !!}
    </h1>

    <!-- Subheadline -->
    <p class="text-lg md:text-xl max-w-3xl mx-auto mb-10 animate-hero-pop" style="color:#454745;animation-delay:.3s;line-height:1.6">
      {{ $hero->subheadline ?? 'Building the infrastructure layer for a chainless,' }}
    </p>

    <!-- CTAs -->
    <div class="flex flex-wrap justify-center gap-4 mb-10 animate-fade-in-up" style="animation-delay:.5s">
      <a href="{{ $hero->cta_primary_url ?? '#' }}"
         class="shimmer-btn px-8 py-4 font-bold text-base transition-all duration-200 hover:-translate-y-0.5"
         style="background:#9FE870;color:#1A1A1A;border-radius:999px;letter-spacing:0.02em;border:none;display:inline-flex;align-items:center;text-decoration:none">
        {{ $hero->cta_primary_text ?? 'Start Building' }}
      </a>
      <a href="{{ $hero->cta_secondary_url ?? '#' }}" target="_blank"
         class="btn-wise-secondary px-8 py-4 font-semibold text-base transition-all duration-200"
         style="background:#FFFFFF;color:#1A1A1A;border:1px solid #C8C8C2;border-radius:999px;letter-spacing:0.02em;display:inline-flex;align-items:center;gap:8px;text-decoration:none">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        {{ $hero->cta_secondary_text ?? 'Download Whitepaper' }}
      </a>
    </div>

    <!-- App Download Buttons -->
    @php
        $appStoreUrl   = \App\Models\SiteSetting::get('app_store_url', '');
        $androidApkUrl = \App\Models\SiteSetting::get('android_apk_url', '');
    @endphp
    @if($appStoreUrl || $androidApkUrl)
    <style>
      .app-dl-btn { background:rgba(26,26,26,.07); border:1px solid rgba(26,26,26,.13); text-decoration:none; }
      .app-dl-btn:hover { background:rgba(26,26,26,.13); }
      .dark .app-dl-btn { background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.14); }
      .dark .app-dl-btn:hover { background:rgba(255,255,255,.13); }
      .app-dl-label { color:#6B6B68; }
      .dark .app-dl-label { color:rgba(255,255,255,.45); }
      .app-dl-name  { color:#1A1A1A; }
      .dark .app-dl-name  { color:#F0F0EC; }
      .app-dl-icon  { fill:#1A1A1A; }
      .dark .app-dl-icon  { fill:#F0F0EC; }
      .app-dl-ver   { color:#9B9B98; }
      .dark .app-dl-ver   { color:rgba(255,255,255,.35); }
    </style>
    <div class="flex justify-center mb-14 animate-fade-in-up" style="animation-delay:.65s">
      <div class="flex flex-col gap-3">
        <div class="flex gap-3">
          @if($appStoreUrl)
          <a href="{{ $appStoreUrl }}" target="_blank"
             class="app-dl-btn flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-200 min-w-[150px]">
            <svg class="app-dl-icon w-6 h-6 flex-shrink-0" viewBox="0 0 24 24">
              <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.61-.91.61.03 2.34.25 3.44 1.86-2.73 1.36-2.3 5.48.5 6.68-.34.83-.8 1.64-1.45 2.62zM13 3.5c.52-1.19 2.05-2.3 3.61-2.02.26 1.54-1.12 3.12-2.35 3.64-.67.28-2.11 0-1.26-1.62z"/>
            </svg>
            <div class="text-left">
              <div class="app-dl-label text-[10px] uppercase font-bold tracking-wider leading-none mb-1">INSTALL</div>
              <div class="app-dl-name text-sm font-bold leading-none">App Store</div>
            </div>
          </a>
          @endif
          @if($androidApkUrl)
          <a href="{{ $androidApkUrl }}" download
             class="app-dl-btn flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-200 min-w-[150px]">
            <svg class="app-dl-icon w-6 h-6 flex-shrink-0" viewBox="0 0 24 24">
              <path d="M3,20.5V3.5C3,2.91,3.34,2.39,3.84,2.15L13.69,12L3.84,21.85C3.34,21.6,3,21.09,3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.3,12.5L17.38,15.69L15.12,13.42L20.3,10.5C20.56,10.65,20.56,11,20.3,11.5M13.69,12L3.84,2.15L6.05,2.66L16.81,8.88L13.69,12Z"/>
            </svg>
            <div class="text-left">
              <div class="app-dl-label text-[10px] uppercase font-bold tracking-wider leading-none mb-1">INSTALL</div>
              <div class="app-dl-name text-sm font-bold leading-none">Google Play</div>
            </div>
          </a>
          @endif
        </div>
        @php $appVerText = \App\Models\SiteSetting::get('app_version_text', 'v2.4.0 (Beta) • iOS 16+ • Android 13+'); @endphp
        @if($appVerText)
        <div class="app-dl-ver flex items-center gap-2 text-[10px] font-mono">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7V5a2 2 0 0 1 2-2h2"/><path d="M17 3h2a2 2 0 0 1 2 2v2"/><path d="M21 17v2a2 2 0 0 1-2 2h-2"/><path d="M7 21H5a2 2 0 0 1-2-2v-2"/><path d="M7 12h10"/></svg>
          <span>{{ $appVerText }}</span>
        </div>
        @endif
      </div>
    </div>
    @endif

    <!-- Stats -->
    @php $heroStats = json_decode($hero->stats_json ?? '[]', true) ?? []; @endphp
    @if($heroStats)
    <div class="flex flex-wrap justify-center gap-8 md:gap-16 mb-14">
      @foreach($heroStats as $i => $stat)
        @if(!empty($stat['value']))
        <div class="text-center animate-fade-in-up" style="animation-delay:{{ 0.6 + $i * 0.1 }}s" data-animate>
          <div class="text-3xl md:text-4xl font-black" style="color:#1A1A1A;letter-spacing:-0.03em">{{ $stat['value'] }}</div>
          <div class="text-sm mt-1" style="color:#6B6B68">{{ $stat['label'] ?? '' }}</div>
        </div>
        @endif
      @endforeach
    </div>
    @endif

    <!-- Email form -->
    <form id="subscribe-form" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto animate-fade-in-up" style="animation-delay:.9s">
      <input type="email" name="email" placeholder="{{ $hero->email_placeholder ?? 'Enter your email' }}"
        class="flex-1 px-5 py-3.5 focus:outline-none transition text-sm"
        style="background:#FFFFFF;border:1px solid #C8C8C2;border-radius:999px;color:#1A1A1A">
      <button type="submit"
        class="px-6 py-3.5 font-semibold text-sm whitespace-nowrap transition-all duration-200"
        style="background:#1A1A1A;color:#FFFFFF;border-radius:999px;border:none">
        {{ $hero->email_cta ?? 'Stay Updated' }}
      </button>
    </form>
    <p id="subscribe-message" style="display:none;color:#2D7A0F;font-size:0.85rem;margin-top:12px"></p>
  </div>

  <!-- Scroll indicator -->
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce" style="opacity:0.3">
    <svg class="w-6 h-6" fill="none" stroke="#1A1A1A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
  </div>
</section>
