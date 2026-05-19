<section id="roadmap" class="pb-24 px-6" style="background:#EEECEA">
  <div class="max-w-7xl mx-auto">

    <div class="text-center mb-14" data-animate>
      <div class="section-label mb-4">Roadmap</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">Building the Future, Step by Step</h2>
    </div>

    @php
    $phaseIcons = [
      1 => '<rect width="20" height="8" x="2" y="2" rx="2" ry="2"/><rect width="20" height="8" x="2" y="14" rx="2" ry="2"/><line x1="6" x2="6.01" y1="6" y2="6"/><line x1="6" x2="6.01" y1="18" y2="18"/>',
      2 => '<path d="M12 18V5"/><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"/><path d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 1 0-5.598 1.5"/><path d="M17.997 5.125a4 4 0 0 1 2.526 5.77"/><path d="M18 18a4 4 0 0 0 2-7.464"/><path d="M19.967 17.483A4 4 0 1 1 12 18a4 4 0 1 1-7.967-.517"/><path d="M6 18a4 4 0 0 1-2-7.464"/><path d="M6.003 5.125a4 4 0 0 0-2.526 5.77"/>',
      3 => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/>',
      4 => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
    ];
    $cardTypes = [1 => 'dark', 2 => 'green', 3 => 'content', 4 => 'sage'];
    @endphp

    <div class="roadmap-card-grid">

      @foreach($roadmap->sortBy('stage_number') as $stage)
      @php
        $num      = $stage->stage_number;
        $cardType = $cardTypes[$num] ?? 'content';
        $icon     = $phaseIcons[$num] ?? $phaseIcons[1];
        $milestones = $stage->milestones_json ?? [];
        $isActive    = $stage->status === 'active';
        $isCompleted = $stage->status === 'completed';
        $statusLabel = $isActive ? 'Current' : ($isCompleted ? 'Completed' : 'Upcoming');
      @endphp

      @if($num === 1)
      {{-- ─── PHASE 1: Full-width dark banner ─── --}}
      <div class="feat-card dark phase-current animate-scale-in" data-animate
           style="background:linear-gradient(135deg,#1E1E1E 0%,#141414 100%);border:1px solid rgba(159,232,112,0.15);box-shadow:0 0 0 1px rgba(159,232,112,0.08),0 24px 48px rgba(0,0,0,0.3);position:relative;overflow:hidden">

        {{-- Decorative top-right glow --}}
        <div style="position:absolute;top:-60px;right:-60px;width:200px;height:200px;border-radius:50%;background:radial-gradient(circle,rgba(159,232,112,0.08) 0%,transparent 70%);pointer-events:none"></div>

        {{-- LEFT column: eyebrow + icon + title + progress + stats --}}
        <div style="display:flex;flex-direction:column;gap:20px;position:relative;z-index:1">

          {{-- Eyebrow + LIVE badge --}}
          <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
            <span class="eyebrow">{{ $statusLabel }} — {{ $stage->timeframe }}</span>
            <span style="background:#9FE870;color:#1A1A1A;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;letter-spacing:0.05em;display:inline-flex;align-items:center;gap:4px">
              <span class="animate-pulse" style="width:6px;height:6px;border-radius:50%;background:#1A1A1A;display:inline-block"></span>
              LIVE
            </span>
          </div>

          {{-- Icon + Title --}}
          <div style="display:flex;align-items:center;gap:14px">
            <div class="phase-icon-wrap">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icon !!}</svg>
            </div>
            <h3 style="font-size:26px;font-weight:800;letter-spacing:-0.02em;margin:0;color:#9FE870;line-height:1.2">
              Phase {{ $num }}: {{ $stage->name }}
            </h3>
          </div>

          {{-- Short description --}}
          <p style="color:rgba(255,255,255,0.5);font-size:14px;line-height:1.6;margin:0">
            The foundation is live. Core infrastructure, AI engine, and chain abstraction layers are being deployed across the network.
          </p>

          {{-- Progress bar --}}
          <div style="margin-top:4px">
            <div style="display:flex;justify-content:space-between;margin-bottom:8px">
              <span style="font-size:12px;color:rgba(255,255,255,0.4);font-weight:600;letter-spacing:0.05em">DEPLOYMENT PROGRESS</span>
              <span style="font-size:12px;color:#9FE870;font-weight:700">65%</span>
            </div>
            <div style="height:4px;background:rgba(255,255,255,0.1);border-radius:999px;overflow:hidden">
              <div style="width:65%;height:100%;background:#9FE870;border-radius:999px;box-shadow:0 0 12px rgba(159,232,112,0.5)"></div>
            </div>
          </div>

          {{-- Mini stat pills --}}
          <div style="display:flex;gap:8px;flex-wrap:wrap">
            <span style="background:rgba(159,232,112,0.1);border:1px solid rgba(159,232,112,0.2);color:#9FE870;font-size:12px;font-weight:600;padding:6px 14px;border-radius:999px">✓ Mainnet Live</span>
            <span style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.5);font-size:12px;font-weight:600;padding:6px 14px;border-radius:999px">{{ count($milestones) }} Milestones</span>
            <span style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.5);font-size:12px;font-weight:600;padding:6px 14px;border-radius:999px">{{ $stage->timeframe }}</span>
          </div>

        </div>

        {{-- RIGHT column: checkmark milestones + left divider --}}
        <ul class="milestone-list" style="padding-top:4px;border-left:1px solid rgba(255,255,255,0.06);padding-left:32px;position:relative;z-index:1">
          @foreach($milestones as $milestone)
            <li>{{ $milestone }}</li>
          @endforeach
        </ul>

      </div>

      @else
      {{-- ─── PHASES 2, 3, 4: Compact third-width cards ─── --}}
      <div class="feat-card {{ $cardType }} phase-upcoming animate-scale-in" data-animate style="animation-delay:{{ ($loop->index) * 60 }}ms">

        {{-- Eyebrow --}}
        @if($cardType === 'green')
          <span class="eyebrow" style="color:#2D7A0F">{{ $statusLabel }} — {{ $stage->timeframe }}</span>
        @else
          <span class="eyebrow">{{ $statusLabel }} — {{ $stage->timeframe }}</span>
        @endif

        {{-- Icon + Title --}}
        <div style="display:flex;align-items:center;gap:12px">
          @if($cardType === 'green')
            <div class="phase-icon-wrap" style="background:#C8EDB0;color:#2D7A0F">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icon !!}</svg>
            </div>
          @else
            <div class="phase-icon-wrap">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icon !!}</svg>
            </div>
          @endif
          <h3 style="font-size:18px;font-weight:800;letter-spacing:-0.02em;margin:0;color:#1A1A1A;line-height:1.25">
            Phase {{ $num }}: {{ $stage->name }}
          </h3>
        </div>

        {{-- First 4 milestones (always visible) --}}
        <ul class="milestone-list">
          @foreach(array_slice($milestones, 0, 4) as $milestone)
            <li>{{ $milestone }}</li>
          @endforeach
        </ul>

        {{-- Remaining milestones (hidden by default) --}}
        @if(count($milestones) > 4)
          <ul class="milestone-list" id="extra-phase-{{ $num }}" style="display:none;margin-top:-8px">
            @foreach(array_slice($milestones, 4) as $milestone)
              <li>{{ $milestone }}</li>
            @endforeach
          </ul>
          <button class="view-all-btn" onclick="toggleRoadmapPhase({{ $num }}, this)" aria-expanded="false">
            View all ({{ count($milestones) - 4 }} more) →
          </button>
        @endif

      </div>
      @endif

      @endforeach

    </div>

  </div>
</section>

<script>
function toggleRoadmapPhase(num, btn) {
  var extra = document.getElementById('extra-phase-' + num);
  var expanded = btn.getAttribute('aria-expanded') === 'true';
  if (expanded) {
    extra.style.display = 'none';
    btn.setAttribute('aria-expanded', 'false');
    btn.textContent = 'View all (' + extra.querySelectorAll('li').length + ' more) →';
  } else {
    extra.style.display = 'flex';
    extra.style.flexDirection = 'column';
    extra.style.gap = '10px';
    btn.setAttribute('aria-expanded', 'true');
    btn.textContent = 'Show less ↑';
  }
}
</script>
