<!DOCTYPE html>
<html lang="en" class="dark">
<script>
  // Apply theme immediately to prevent flash
  if (localStorage.getItem('theme') === 'light') {
    document.documentElement.classList.remove('dark');
  } else {
    document.documentElement.classList.add('dark');
  }
</script>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ \App\Models\SiteSetting::get('meta_title', 'Aeterna | AI Native & Chain Abstraction Layer') }}</title>
<meta name="description" content="{{ \App\Models\SiteSetting::get('meta_description', 'Deploy AI Agents across 15+ chains.') }}">
<link rel="icon" href="{{ \App\Models\SiteSetting::get('favicon_url', 'https://www.aeternaio.com/favicon.ico') }}">

<script>
tailwind = { config: {
  darkMode: 'class',
  theme: { extend: {
    colors: { nexus: { black:'#0a0a0a',dark:'#111111',gray:'#222222',light:'#f5f5f5',accent:'#ffffff',yellow:'#EBFF00' } },
    fontFamily: { sans:['Inter','sans-serif'], mono:['Fira Code','monospace'] },
  }},
}};
</script>
<script src="/site-assets/saved_resource"></script>
<link href="/site-assets/css2" rel="stylesheet">
<link href="/site-assets/prism-tomorrow.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<link rel="stylesheet" href="/css/animations.css">
<link rel="stylesheet" href="/css/app.css">

<style>
body{background:#F5F4F0;color:#1A1A1A;font-family:'Inter',sans-serif;}
#main-nav{transition:background .3s,border-color .3s,box-shadow .3s;}
.shimmer-btn{position:relative;overflow:hidden;}
.shimmer-btn::after{content:'';position:absolute;top:0;left:-60px;width:60px;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.25),transparent);animation:shimmer 2s infinite;}
.card-beam{position:relative;overflow:hidden;}
.active-tab{background:#EBFF00 !important;color:#0D0D0D !important;border-color:#EBFF00 !important;font-weight:700;}
#back-to-top{transition:opacity .3s;}
[data-animate]{opacity:0;transform:translateY(30px);transition:opacity .7s ease,transform .7s ease;}
[data-animate].animated{opacity:1;transform:translateY(0);}
</style>
@yield('head')
@php $customCss = \App\Models\SiteSetting::get('custom_css',''); @endphp
@if($customCss)
<style id="custom-css">{!! $customCss !!}</style>
@endif
</head>
<body class="dark">

@include('public.partials.navbar')
<main>@yield('content')</main>
@include('public.partials.footer')

<button id="back-to-top" style="opacity:0" class="fixed bottom-6 right-20 z-40 w-12 h-12 rounded-full bg-[#222] border border-white/10 text-white flex items-center justify-center hover:border-[#EBFF00] hover:text-[#EBFF00] transition-all">
  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
</button>
<a href="https://discord.gg/rzJKbPSaaQ" target="_blank" class="fixed bottom-6 right-6 z-40 w-12 h-12 rounded-full bg-[#EBFF00] flex items-center justify-center hover:scale-110 transition-transform" title="Join Discord">
  <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M20.317 4.492c-1.53-.69-3.17-1.2-4.885-1.49a.075.075 0 00-.079.036c-.21.369-.444.85-.608 1.23a18.566 18.566 0 00-5.487 0 12.36 12.36 0 00-.617-1.23A.077.077 0 008.562 3c-1.714.29-3.354.8-4.885 1.491a.07.07 0 00-.032.027C.533 9.093-.32 13.555.099 17.961a.08.08 0 00.031.055 20.03 20.03 0 005.993 2.98.078.078 0 00.084-.026c.462-.62.874-1.275 1.226-1.963.021-.04.001-.088-.041-.104a13.201 13.201 0 01-1.872-.878.075.075 0 01-.008-.125c.126-.093.252-.19.372-.287a.075.075 0 01.078-.01c3.927 1.764 8.18 1.764 12.061 0a.075.075 0 01.079.009c.12.098.245.195.372.288a.075.075 0 01-.006.125c-.598.344-1.22.635-1.873.877a.075.075 0 00-.041.105c.36.687.772 1.341 1.225 1.962a.077.077 0 00.084.028 19.963 19.963 0 006.002-2.981.076.076 0 00.032-.054c.5-5.094-.838-9.52-3.549-13.442a.06.06 0 00-.031-.028z"/></svg>
</a>

<script src="/site-assets/prism.min.js.download"></script>
<script src="/site-assets/prism-typescript.min.js.download"></script>
<script src="/js/app.js"></script>
@yield('scripts')
@stack('scripts')
@php $customJs = \App\Models\SiteSetting::get('custom_js',''); @endphp
@if($customJs)
<script id="custom-js">{!! $customJs !!}</script>
@endif
</body>
</html>
