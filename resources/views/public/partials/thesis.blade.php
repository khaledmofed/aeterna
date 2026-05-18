<section id="thesis" class="py-24 px-6 bg-[#0a0a0a]">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/3 text-white/60 text-sm mb-4">Vision</div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Internet Reconstruction Thesis</h2>
      <p class="text-white/50 text-lg max-w-2xl mx-auto">The value the internet creates should flow back to the people who create it.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8" data-animate>
      <!-- Web2 flow -->
      <div class="bg-[#111] border border-red-500/20 rounded-2xl p-8">
        <h3 class="text-lg font-bold text-red-400 mb-6 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          Web2 Value Flow
        </h3>
        @php $web2 = [
          ['Users create value','Users generate all content, data & attention'],
          ['Platforms capture','Platform extracts 15–40% of every transaction'],
          ['Shareholders profit','Value flows to VCs and public shareholders'],
          ['Users receive $0','Creators and users get nothing from the value they create'],
        ]; @endphp
        @foreach($web2 as $i => $step)
        <div class="flex items-start gap-4 {{ !$loop->last ? 'mb-4' : '' }}">
          <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-red-500/15 border border-red-500/30 flex items-center justify-center text-red-400 text-xs font-bold flex-shrink-0">{{ $i+1 }}</div>
            @if(!$loop->last)<div class="w-px h-8 bg-red-500/20 my-1"></div>@endif
          </div>
          <div class="pt-1.5">
            <div class="text-white font-medium text-sm">{{ $step[0] }}</div>
            <div class="text-white/40 text-xs mt-0.5">{{ $step[1] }}</div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Aeterna flow -->
      <div class="bg-gradient-to-br from-[#EBFF00]/5 to-transparent border border-[#EBFF00]/25 rounded-2xl p-8">
        <h3 class="text-lg font-bold text-[#EBFF00] mb-6 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
          Aeterna Value Flow
        </h3>
        @php $aeterna = [
          ['Users create value','Users generate all content, data & attention'],
          ['Protocol captures 0.02–0.1%','Minimal protocol fee — 99.9%+ stays in the ecosystem'],
          ['90% burned permanently','Token supply decreases, increasing value for all holders'],
          ['10% to stakers + you earn','Active participants earn directly from every transaction'],
        ]; @endphp
        @foreach($aeterna as $i => $step)
        <div class="flex items-start gap-4 {{ !$loop->last ? 'mb-4' : '' }}">
          <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-[#EBFF00]/15 border border-[#EBFF00]/30 flex items-center justify-center text-[#EBFF00] text-xs font-bold flex-shrink-0">{{ $i+1 }}</div>
            @if(!$loop->last)<div class="w-px h-8 bg-[#EBFF00]/20 my-1"></div>@endif
          </div>
          <div class="pt-1.5">
            <div class="text-white font-medium text-sm">{{ $step[0] }}</div>
            <div class="text-white/40 text-xs mt-0.5">{{ $step[1] }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
