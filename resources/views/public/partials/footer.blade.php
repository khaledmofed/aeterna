<footer class="bg-[#111] border-t border-white/5 pt-16 pb-8 px-6">
  <div class="max-w-7xl mx-auto">
    <div class="grid md:grid-cols-5 gap-10 mb-12">
      <!-- Brand -->
      <div class="md:col-span-1">
        <div class="text-xl font-bold text-white mb-3">Aeterna<span class="text-[#EBFF00]">.</span></div>
        <p class="text-white/40 text-sm leading-relaxed">RWA Infrastructure for the Open UBI Era. AI Native, Chain Abstracted Layer 1.</p>
        <p class="text-white/30 text-xs mt-2">One address, infinite possibilities.</p>
        <!-- Social links -->
        <div class="flex gap-3 mt-5">
          <a href="{{ \App\Models\SiteSetting::get('twitter_url','#') }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-white hover:border-white/25 transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="{{ \App\Models\SiteSetting::get('discord_url','#') }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-white hover:border-white/25 transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.317 4.492a20.29 20.29 0 00-4.885-1.49.075.075 0 00-.079.036c-.21.369-.444.85-.608 1.23a18.566 18.566 0 00-5.487 0 12.36 12.36 0 00-.617-1.23A.077.077 0 008.562 3a20.283 20.283 0 00-4.885 1.491.07.07 0 00-.032.027C.533 9.093-.32 13.555.099 17.961a.08.08 0 00.031.055 20.03 20.03 0 005.993 2.98.078.078 0 00.084-.026c.462-.62.874-1.275 1.226-1.963.021-.04.001-.088-.041-.104a13.201 13.201 0 01-1.872-.878.075.075 0 01-.008-.125c.126-.093.252-.19.372-.287a.075.075 0 01.078-.01c3.927 1.764 8.18 1.764 12.061 0a.075.075 0 01.079.009c.12.098.245.195.372.288a.075.075 0 01-.006.125c-.598.344-1.22.635-1.873.877a.075.075 0 00-.041.105c.36.687.772 1.341 1.225 1.962a.077.077 0 00.084.028 19.963 19.963 0 006.002-2.981.076.076 0 00.032-.054c.5-5.094-.838-9.52-3.549-13.442a.06.06 0 00-.031-.028z"/></svg>
          </a>
          <a href="{{ \App\Models\SiteSetting::get('github_url','#') }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-white hover:border-white/25 transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2A10 10 0 002 12c0 4.42 2.87 8.17 6.84 9.5.5.08.66-.23.66-.5v-1.69c-2.77.6-3.36-1.34-3.36-1.34-.46-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.87 1.52 2.34 1.07 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.92 0-1.11.38-2 1.03-2.71-.1-.25-.45-1.29.1-2.64 0 0 .84-.27 2.75 1.02.79-.22 1.65-.33 2.5-.33.85 0 1.71.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.35.2 2.39.1 2.64.65.71 1.03 1.6 1.03 2.71 0 3.82-2.34 4.66-4.57 4.91.36.31.69.92.69 1.85V21c0 .27.16.59.67.5C19.14 20.16 22 16.42 22 12A10 10 0 0012 2z"/></svg>
          </a>
        </div>
      </div>

      <!-- Link groups -->
      @foreach($footerLinks as $group => $links)
      <div>
        <h4 class="text-white font-semibold text-sm mb-4">{{ $group }}</h4>
        <ul class="flex flex-col gap-2.5">
          @foreach($links as $link)
          <li>
            <a href="{{ $link->url }}" target="{{ $link->url === '#' ? '_self' : '_blank' }}" class="text-white/45 text-sm hover:text-white/80 transition">{{ $link->label }}</a>
          </li>
          @endforeach
        </ul>
      </div>
      @endforeach
    </div>

    <!-- Bottom bar -->
    <div class="border-t border-white/5 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3">
      <p class="text-white/30 text-sm">© 2025 Aeterna Foundation. All rights reserved.</p>
      <p class="text-white/20 text-xs font-mono">AI Native · Chain Abstracted · Layer 1</p>
    </div>
  </div>
</footer>
