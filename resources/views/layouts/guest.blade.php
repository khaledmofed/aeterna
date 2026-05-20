<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Aeterna') }} — Sign In</title>
  <link rel="icon" href="https://www.aeternaio.com/favicon.ico">
  <script>tailwind={config:{theme:{extend:{}}}};</script>
  <script src="/site-assets/saved_resource"></script>
  <link href="/site-assets/css2" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background: #E8E8E3; }
    input:focus { outline: none; border-color: #9FE870 !important; box-shadow: 0 0 0 3px rgba(159,232,112,0.15); }
    input { border: 1px solid #C8C8C2; border-radius: 8px; padding: 10px 14px; width: 100%; font-size: 14px; background: #fff; }
    label { font-size: 13px; font-weight: 600; color: #1A1A1A; display: block; margin-bottom: 6px; }
  </style>
</head>
<body class="antialiased">

  <div class="min-h-screen flex flex-col items-center justify-center px-4">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="flex items-center gap-2 mb-8">
      <span class="text-2xl font-black tracking-tighter" style="color:#1A1A1A;letter-spacing:-0.04em">AETERNA</span>
      <span style="background:#9FE870;color:#1A1A1A;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;letter-spacing:0.05em">ADMIN</span>
    </a>

    <!-- Card -->
    <div class="w-full max-w-md rounded-3xl p-8" style="background:#FFFFFF;box-shadow:0 8px 40px rgba(0,0,0,0.08)">
      {{ $slot }}
    </div>

    <p class="mt-6 text-xs" style="color:#9A9A96">
      &copy; {{ date('Y') }} Aeterna Foundation. All rights reserved.
    </p>

  </div>

</body>
</html>
