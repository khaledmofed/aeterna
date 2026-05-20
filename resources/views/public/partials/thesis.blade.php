<section id="thesis" class="py-24 px-6" style="background:#F5F4F0">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-16" data-animate>
      <div class="section-label mb-4">Vision</div>
      <h2 class="text-4xl md:text-5xl font-bold mb-4" style="color:#1A1A1A;font-weight:900;letter-spacing:-0.03em">Internet Reconstruction Thesis</h2>
      <p class="text-lg max-w-2xl mx-auto" style="color:#454745">The value the internet creates should flow back to the people who create it.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8" data-animate>
      <!-- Web2 flow -->
      <div class="rounded-2xl p-8" style="background:#FFFFFF;border:1px solid rgba(239,68,68,0.25)">
        <h3 class="text-lg font-bold mb-6 flex items-center gap-2" style="color:rgb(239,68,68)">
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
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:rgb(239,68,68)">{{ $i+1 }}</div>
            @if(!$loop->last)<div class="w-px h-8 my-1" style="background:rgba(239,68,68,0.15)"></div>@endif
          </div>
          <div class="pt-1.5">
            <div class="font-medium text-sm" style="color:#1A1A1A">{{ $step[0] }}</div>
            <div class="text-xs mt-0.5" style="color:#454745">{{ $step[1] }}</div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Aeterna flow -->
      <div class="rounded-2xl p-8" style="background:linear-gradient(135deg,rgba(235,255,0,0.07) 0%,transparent 60%);border:1px solid rgba(235,255,0,0.3)">
        <h3 class="text-lg font-bold mb-6 flex items-center gap-2" style="color:#1A1A1A">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color:#EBFF00"><path d="M20 6 9 17l-5-5"/></svg>
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
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0" style="background:#FFFFFF;border:1px solid #1A1A1A;color:#1A1A1A;box-shadow:none">{{ $i+1 }}</div>
            @if(!$loop->last)<div class="w-px h-8 my-1" style="background:rgba(26,26,26,0.15)"></div>@endif
          </div>
          <div class="pt-1.5">
            <div class="font-medium text-sm" style="color:#1A1A1A">{{ $step[0] }}</div>
            <div class="text-xs mt-0.5" style="color:#454745">{{ $step[1] }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
