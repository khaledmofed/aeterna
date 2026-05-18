<section id="roadmap" class="py-24 px-6 bg-[#111]">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-20" data-animate>
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/3 text-white/60 text-sm mb-4">Roadmap</div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Building the Future, Step by Step</h2>
    </div>

    @php
    $phaseIcons = [
      1 => '<rect width="20" height="8" x="2" y="2" rx="2" ry="2"/><rect width="20" height="8" x="2" y="14" rx="2" ry="2"/><line x1="6" x2="6.01" y1="6" y2="6"/><line x1="6" x2="6.01" y1="18" y2="18"/>',
      2 => '<path d="M12 18V5"/><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"/><path d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 1 0-5.598 1.5"/><path d="M17.997 5.125a4 4 0 0 1 2.526 5.77"/><path d="M18 18a4 4 0 0 0 2-7.464"/><path d="M19.967 17.483A4 4 0 1 1 12 18a4 4 0 1 1-7.967-.517"/><path d="M6 18a4 4 0 0 1-2-7.464"/><path d="M6.003 5.125a4 4 0 0 0-2.526 5.77"/>',
      3 => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/>',
      4 => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
    ];
    @endphp

    <div class="max-w-5xl mx-auto relative overflow-hidden">

      {{-- Vertical center line with animated beam --}}
      <div class="absolute top-0 left-8 md:left-1/2 -translate-x-1/2 w-px h-full bg-white/10 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-transparent via-[#EBFF00] to-transparent animate-beam opacity-50"></div>
      </div>

      @foreach($roadmap as $i => $stage)
      @php
        $isCompleted = $stage->status === 'completed';
        $isActive    = $stage->status === 'active';
        $isRight     = $i % 2 === 1;
        $icon        = $phaseIcons[$stage->stage_number] ?? $phaseIcons[1];
      @endphp

      {{-- Row: alternates left/right on desktop --}}
      <div class="flex flex-col {{ $isRight ? 'md:flex-row-reverse' : 'md:flex-row' }} items-center justify-between mb-16 md:mb-0 relative w-full">

        {{-- Timeline node — desktop (center) --}}
        @if($isCompleted)
          <div class="hidden md:flex absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 items-center justify-center w-8 h-8 rounded-full border-2 z-20 border-[#EBFF00] bg-[#EBFF00] text-black shadow-[0_0_10px_#EBFF00]">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
          </div>
        @elseif($isActive)
          <div class="hidden md:flex absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 items-center justify-center w-8 h-8 rounded-full border-2 z-20 border-[#EBFF00] animate-pulse bg-black shadow-[0_0_20px_#EBFF00]">
            <div class="w-3 h-3 bg-[#EBFF00] rounded-full animate-ping opacity-75"></div>
          </div>
        @else
          <div class="hidden md:flex absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 items-center justify-center w-8 h-8 rounded-full border-2 z-20 border-neutral-800 bg-neutral-900">
            <div class="w-2 h-2 bg-neutral-700 rounded-full"></div>
          </div>
        @endif

        {{-- Timeline node — mobile (left rail) --}}
        @if($isCompleted)
          <div class="md:hidden absolute left-8 top-0 -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full border-2 z-20 border-[#EBFF00] bg-[#EBFF00] text-black shadow-[0_0_10px_#EBFF00]">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
          </div>
        @elseif($isActive)
          <div class="md:hidden absolute left-8 top-0 -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full border-2 z-20 border-[#EBFF00] animate-pulse bg-black shadow-[0_0_20px_#EBFF00]">
            <div class="w-3 h-3 bg-[#EBFF00] rounded-full animate-ping opacity-75"></div>
          </div>
        @else
          <div class="md:hidden absolute left-8 top-0 -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full border-2 z-20 border-neutral-800 bg-neutral-900"></div>
        @endif

        {{-- Card --}}
        <div class="w-full md:w-[42%] pl-16 md:pl-0 {{ $isRight ? 'md:text-left' : 'md:text-right' }} relative md:py-12">
          <div class="animate-scale-in" style="animation-delay:{{ $i * 100 }}ms" data-animate>
            <div class="group relative overflow-hidden rounded-2xl p-8 border transition-all duration-500
              {{ $isActive
                  ? 'border-[#EBFF00]/50 shadow-[0_0_30px_rgba(235,255,0,0.12)] bg-neutral-900/30'
                  : 'border-white/10 bg-neutral-900/30 hover:border-white/20' }}">

              {{-- Hover spotlight glow --}}
              <div class="absolute inset-0 opacity-0 group-hover:opacity-20 transition-opacity duration-500 bg-gradient-to-br {{ $isActive ? 'from-[#EBFF00]/10' : 'from-white/10' }} to-transparent pointer-events-none"></div>

              {{-- Ghost icon corner --}}
              <div class="absolute {{ $isRight ? '-right-8 -bottom-8' : '-left-8 -bottom-8' }}
                           {{ $isActive ? 'opacity-[0.07] text-[#EBFF00]' : 'opacity-[0.03] text-white' }}
                           group-hover:opacity-10 transition-all duration-700 group-hover:scale-125 group-hover:rotate-12 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="180" height="180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icon !!}</svg>
              </div>

              <div class="relative z-10 flex flex-col h-full">

                {{-- Status + timeframe --}}
                <div class="flex items-center gap-3 mb-4 {{ $isRight ? '' : 'md:justify-end' }}">
                  @if($isCompleted)
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border border-white/10 text-neutral-500 bg-white/5">completed</span>
                  @elseif($isActive)
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border border-[#EBFF00]/30 text-[#EBFF00] bg-[#EBFF00]/10">current</span>
                  @else
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border border-white/10 text-neutral-500 bg-white/5">upcoming</span>
                  @endif
                  <span class="font-mono text-sm {{ $isActive ? 'text-[#EBFF00]' : 'text-neutral-500' }}">{{ $stage->timeframe }}</span>
                </div>

                {{-- Icon + title --}}
                <h3 class="text-2xl font-bold mb-6 text-white flex items-center gap-3 {{ $isRight ? '' : 'md:flex-row-reverse' }}">
                  <div class="flex items-center justify-center w-10 h-10 rounded-lg border backdrop-blur-sm transition-all duration-300 group-hover:scale-110 shrink-0
                    {{ $isActive
                        ? 'bg-[#EBFF00] text-black border-[#EBFF00]'
                        : 'bg-white/5 text-white border-white/10 group-hover:bg-[#EBFF00] group-hover:text-black group-hover:border-[#EBFF00]' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icon !!}</svg>
                  </div>
                  <span class="group-hover:text-[#EBFF00] transition-colors duration-300">Phase {{ $stage->stage_number }}: {{ $stage->name }}</span>
                </h3>

                {{-- Milestones --}}
                <ul class="space-y-3 flex flex-col {{ $isRight ? 'md:items-start' : 'md:items-end' }}">
                  @foreach($stage->milestones_json ?? [] as $milestone)
                  <li class="flex items-center gap-3 group/item">
                    @if($isRight)
                      <span class="w-1.5 h-1.5 rounded-full flex-shrink-0 transition-colors duration-300 {{ $isActive ? 'bg-[#EBFF00]/70' : 'bg-neutral-800 group-hover/item:bg-white' }}"></span>
                      <span class="text-sm transition-colors duration-300 {{ $isActive ? 'text-neutral-300' : 'text-neutral-500 group-hover/item:text-neutral-300' }}">{{ $milestone }}</span>
                    @else
                      <span class="hidden md:block w-1.5 h-1.5 rounded-full flex-shrink-0 transition-colors duration-300 {{ $isActive ? 'bg-[#EBFF00]/70' : 'bg-neutral-800 group-hover/item:bg-white' }}"></span>
                      <span class="text-sm transition-colors duration-300 {{ $isActive ? 'text-neutral-300' : 'text-neutral-500 group-hover/item:text-neutral-300' }}">{{ $milestone }}</span>
                      <span class="md:hidden w-1.5 h-1.5 rounded-full flex-shrink-0 {{ $isActive ? 'bg-[#EBFF00]/70' : 'bg-neutral-800' }}"></span>
                    @endif
                  </li>
                  @endforeach
                </ul>

              </div>
            </div>
          </div>
        </div>

        {{-- Empty spacer on the opposite side --}}
        <div class="hidden md:block w-[42%]"></div>
      </div>
      @endforeach

    </div>
  </div>
</section>
