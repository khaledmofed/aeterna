<section id="hero" class="relative min-h-screen flex flex-col items-center justify-center text-center overflow-hidden px-6 pt-24 pb-16" style="background:#E8E8E3">
  <!-- Canvas particle background -->
  <div id="hero-canvas-wrapper" class="absolute inset-0 w-full h-full pointer-events-none will-change-transform">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <canvas id="hero-canvas" class="block w-full h-full"></canvas>
      <div class="absolute inset-0" style="background:radial-gradient(ellipse 60% 65% at center,#E8E8E3 20%,transparent 70%)"></div>
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
    <div class="flex flex-wrap justify-center gap-4 mb-14 animate-fade-in-up" style="animation-delay:.5s">
      <a href="{{ $hero->cta_primary_url ?? '#' }}"
         class="shimmer-btn px-8 py-4 font-bold text-base transition-all duration-200 hover:-translate-y-0.5"
         style="background:#9FE870;color:#1A1A1A;border-radius:999px;letter-spacing:0.02em;border:none;display:inline-flex;align-items:center;text-decoration:none">
        {{ $hero->cta_primary_text ?? 'Start Building' }}
      </a>
      <a href="{{ $hero->cta_secondary_url ?? '#' }}" target="_blank"
         class="btn-wise-secondary px-8 py-4 font-semibold text-base transition-all duration-200"
         style="background:#FFFFFF;color:#1A1A1A;border:1px solid #C8C8C2;border-radius:999px;letter-spacing:0.02em;display:inline-flex;align-items:center;text-decoration:none">
        {{ $hero->cta_secondary_text ?? 'Join Discord' }}
      </a>
    </div>

    <!-- Stats -->
    @if($hero->stats_json)
    <div class="flex flex-wrap justify-center gap-8 md:gap-16 mb-14">
      @foreach($hero->stats_json as $i => $stat)
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
