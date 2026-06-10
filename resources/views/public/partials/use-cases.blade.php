<section id="use-cases" class="py-24 px-6" style="background:#F5F4F0">
  <div class="max-w-7xl mx-auto">

    <div class="text-center mb-16" data-animate>
      <div class="section-label mb-4">Use Cases</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">RWA Infrastructure &<br>Open UBI Vision</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:#454745">Real-world value for real-world people ; powered by Aeterna's AI-native, chain-abstracted infrastructure.</p>
    </div>

    <ul class="uc-accordion" id="ucAccordion" data-animate>
      @php
        $ucColors = [
          ['bg'=>'#FFFFFF',  'border'=>'#D6D6D6',              'text'=>'#1A1A1A', 'sub'=>'#454745',              'accent'=>'#9FE870', 'iconBg'=>'rgba(159,232,112,0.15)', 'iconBorder'=>'rgba(159,232,112,0.45)'],
          ['bg'=>'#EEECEA',  'border'=>'#D4D2D0',              'text'=>'#1A1A1A', 'sub'=>'#454745',              'accent'=>'#9FE870', 'iconBg'=>'rgba(159,232,112,0.15)', 'iconBorder'=>'rgba(159,232,112,0.45)'],
          ['bg'=>'#DFF5D0',  'border'=>'#BFDFAB',              'text'=>'#1A1A1A', 'sub'=>'#2E5220',              'accent'=>'#4A8C2A', 'iconBg'=>'rgba(74,140,42,0.12)',   'iconBorder'=>'rgba(74,140,42,0.4)'],
          ['bg'=>'#1A1A1A',  'border'=>'rgba(255,255,255,0.1)','text'=>'#FFFFFF', 'sub'=>'rgba(255,255,255,0.6)','accent'=>'#EBFF00', 'iconBg'=>'rgba(235,255,0,0.1)',    'iconBorder'=>'rgba(235,255,0,0.35)'],
        ];
      @endphp

      @foreach($useCases as $i => $case)
        @php $c = $ucColors[$i % 4]; $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT); @endphp
        <li class="uc-item{{ $i === 0 ? ' uc-active' : '' }}"
            style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }}"
>

          {{-- Collapsed: number + vertical title --}}
          <div class="uc-collapsed">
            <span class="uc-num" style="color:{{ $c['accent'] }}">{{ $num }}</span>
            <h3 class="uc-vtitle" style="color:{{ $c['text'] }}">{{ $case->title }}</h3>
          </div>

          {{-- Expanded: full content --}}
          <div class="uc-expanded">
            <div class="uc-exp-top">
              <div class="uc-icon" style="background:{{ $c['iconBg'] }};border:1.5px solid {{ $c['iconBorder'] }};color:{{ $c['text'] }}">
                {!! $case->icon_svg !!}
              </div>
              <span class="uc-exp-num" style="color:{{ $c['accent'] }}">{{ $num }}</span>
            </div>
            <h2 class="uc-title" style="color:{{ $c['text'] }}">{{ $case->title }}</h2>
            <p class="uc-desc" style="color:{{ $c['sub'] }}">{{ $case->description }}</p>
            @if($case->features_json)
            <div class="uc-features">
              @foreach($case->features_json as $feature)
              <div class="uc-feat">
                <span class="uc-dot" style="background:{{ $c['accent'] }}"></span>
                <div>
                  <div class="uc-feat-title" style="color:{{ $c['text'] }}">{{ $feature['title'] }}</div>
                  <div class="uc-feat-desc" style="color:{{ $c['sub'] }}">{{ $feature['description'] }}</div>
                </div>
              </div>
              @endforeach
            </div>
            @endif
          </div>

        </li>
      @endforeach
    </ul>

  </div>
</section>

<script>
(function() {
  function activateItem(el) {
    document.querySelectorAll('#ucAccordion .uc-item').forEach(function(i) {
      i.classList.remove('uc-active');
    });
    el.classList.add('uc-active');
  }

  document.querySelectorAll('#ucAccordion .uc-item').forEach(function(item) {
    // Desktop: hover
    item.addEventListener('mouseenter', function() {
      if (window.innerWidth > 1024) activateItem(this);
    });
    // Tablet / mobile: tap to expand
    item.addEventListener('click', function() {
      if (!this.classList.contains('uc-active')) activateItem(this);
    });
  });
})();
</script>
