<section id="solutions" class="py-24 px-6" style="background:#0D0D0D">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-14" data-animate>
      <div class="section-label mb-4" style="background:rgba(255,255,255,0.06);border-color:rgba(255,255,255,0.1);color:rgba(255,255,255,0.5)">{{ __('messages.solutions.badge') }}</div>
      <h2 class="text-4xl md:text-5xl mb-4" style="color:#FFFFFF;font-weight:900;letter-spacing:-0.03em">{{ __('messages.solutions.title') }}</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:rgba(255,255,255,0.5)">{{ __('messages.solutions.subtitle') }}</p>
    </div>

    <div class="solutions-table overflow-hidden" style="border:1px solid rgba(255,255,255,0.08);border-radius:16px" data-animate>
      <!-- Header row -->
      <div class="solutions-header-row grid" style="grid-template-columns:1fr 1.4fr 1.4fr;display:grid;background:rgba(255,255,255,0.04);border-bottom:1px solid rgba(255,255,255,0.08)">
        <div class="px-6 py-4 text-xs font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35);letter-spacing:0.1em">{{ __('messages.solutions.challenge') }}</div>
        <div class="px-6 py-4 text-xs font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35);letter-spacing:0.1em;border-left:1px solid rgba(255,255,255,0.06)">{{ __('messages.solutions.current_state') }}</div>
        <div class="px-6 py-4 text-xs font-bold uppercase tracking-widest" style="color:#9FE870;letter-spacing:0.1em;border-left:1px solid rgba(255,255,255,0.06)">{{ __('messages.solutions.aeterna_solution') }}</div>
      </div>

      <!-- Data rows -->
      @foreach($solutions as $i => $row)
      <div class="solutions-data-row grid transition-colors duration-200 hover:bg-white/[0.02]"
           style="grid-template-columns:1fr 1.4fr 1.4fr;display:grid;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,0.06)' : '' }}">
        <div class="px-6 py-5 font-semibold text-sm" data-label="{{ __('messages.solutions.challenge') }}" style="color:#FFFFFF">{{ $row->challenge }}</div>
        <div class="px-6 py-5 text-sm leading-relaxed" data-label="{{ __('messages.solutions.current_state') }}" style="color:rgba(255,255,255,0.45);border-left:1px solid rgba(255,255,255,0.06)">{{ $row->current_state }}</div>
        <div class="px-6 py-5 text-sm leading-relaxed font-medium" data-label="{{ __('messages.solutions.aeterna_solution') }}" style="color:#9FE870;border-left:1px solid rgba(255,255,255,0.06)">{{ $row->aeterna_solution }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>
