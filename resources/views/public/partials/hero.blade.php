<section id="hero" class="relative min-h-screen flex flex-col items-center justify-center text-center overflow-hidden px-6 pt-24 pb-16">
  <!-- Canvas particle background -->
  <div id="hero-canvas-wrapper" class="absolute inset-0 w-full h-full pointer-events-none will-change-transform">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <canvas id="hero-canvas" class="block w-full h-full"></canvas>
      <div class="absolute inset-0" style="background:radial-gradient(circle at center,transparent 0%,#0a0a0a 88%)"></div>
    </div>
  </div>

  <div class="relative z-10 max-w-5xl mx-auto">
    <!-- Badge -->
    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-[#EBFF00]/30 bg-[#EBFF00]/5 text-[#EBFF00] text-sm font-medium mb-6 animate-scale-in">
      <span class="w-2 h-2 rounded-full bg-[#EBFF00] animate-pulse"></span>
      {{ $hero->badge_text ?? 'AI Native Layer 1 — Now Live' }}
    </div>

    <!-- Headline -->
    <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white leading-tight mb-6 animate-hero-title">
      {!! nl2br(e($hero->headline ?? 'The Future is Chainless.')) !!}
    </h1>

    <!-- Subheadline -->
    <p class="text-lg md:text-xl text-white/60 max-w-3xl mx-auto mb-10 animate-hero-pop" style="animation-delay:.3s">
      {{ $hero->subheadline ?? 'Deploy your first AI Agent on Aeterna today.' }}
    </p>

    <!-- CTAs -->
    <div class="flex flex-wrap justify-center gap-4 mb-14 animate-fade-in-up" style="animation-delay:.5s">
      <a href="{{ $hero->cta_primary_url ?? '#' }}" class="shimmer-btn px-8 py-4 rounded-xl bg-[#EBFF00] text-black font-bold text-base hover:opacity-90 transition">
        {{ $hero->cta_primary_text ?? 'Start Building' }}
      </a>
      <a href="{{ $hero->cta_secondary_url ?? '#' }}" target="_blank" class="px-8 py-4 rounded-xl border-2 border-white/30 text-white font-semibold text-base hover:border-white/60 transition">
        {{ $hero->cta_secondary_text ?? 'Join Discord' }}
      </a>
    </div>

    <!-- Stats -->
    @if($hero->stats_json)
    <div class="flex flex-wrap justify-center gap-8 md:gap-16 mb-14">
      @foreach($hero->stats_json as $i => $stat)
      <div class="text-center animate-fade-in-up" style="animation-delay:{{ 0.6 + $i * 0.1 }}s" data-animate>
        <div class="text-3xl md:text-4xl font-bold text-[#EBFF00]">{{ $stat['value'] }}</div>
        <div class="text-sm text-white/50 mt-1">{{ $stat['label'] }}</div>
      </div>
      @endforeach
    </div>
    @endif

    <!-- Email form -->
    <form id="subscribe-form" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto animate-fade-in-up" style="animation-delay:.9s">
      <input type="email" name="email" placeholder="{{ $hero->email_placeholder ?? 'Enter your email' }}"
        class="flex-1 px-5 py-3.5 rounded-xl bg-white/5 border border-white/15 text-white placeholder-white/30 focus:outline-none focus:border-[#EBFF00]/50 focus:bg-white/8 transition text-sm">
      <button type="submit" class="px-6 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white font-semibold text-sm hover:bg-white/15 transition whitespace-nowrap">
        {{ $hero->email_cta ?? 'Stay Updated' }}
      </button>
    </form>
    <p id="subscribe-message" style="display:none" class="text-[#EBFF00] text-sm mt-3"></p>
  </div>

  <!-- Scroll indicator -->
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce opacity-40">
    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
  </div>
</section>
