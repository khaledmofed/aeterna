<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Admin — @yield('title','Dashboard') | AeternaX</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
:root {
  --sidebar-w: 260px;
  --sidebar-bg: #0d0d0d;
  --topbar-bg: #111111;
  --border: rgba(255,255,255,.07);
  --accent: #EBFF00;
  --accent-rgb: 235,255,0;
}
body { background: #0a0a0a; font-family: 'Inter', system-ui, sans-serif; }
/* Sidebar */
#sidebar {
  position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-w);
  background: var(--sidebar-bg); border-right: 1px solid var(--border);
  z-index: 1040; overflow-y: auto; transition: transform .3s;
  display: flex; flex-direction: column;
}
#sidebar .brand { padding: 1.5rem 1.25rem; border-bottom: 1px solid var(--border); }
#sidebar .brand-name { color: #fff; font-weight: 700; font-size: 1.1rem; letter-spacing: -.02em; }
#sidebar .brand-dot { color: var(--accent); }
#sidebar nav a {
  display: flex; align-items: center; gap: .75rem;
  padding: .6rem 1.25rem; color: rgba(255,255,255,.55); text-decoration: none;
  font-size: .85rem; border-radius: .5rem; margin: .1rem .5rem;
  transition: color .15s, background .15s;
}
#sidebar nav a:hover, #sidebar nav a.active {
  color: #fff; background: rgba(255,255,255,.06);
}
#sidebar nav a.active { color: var(--accent); }
#sidebar nav a i { font-size: 1rem; width: 1.2rem; }
#sidebar .sidebar-footer { margin-top: auto; padding: 1rem 1.25rem; border-top: 1px solid var(--border); }
/* Topbar */
#topbar {
  position: fixed; top: 0; left: var(--sidebar-w); right: 0; height: 60px;
  background: var(--topbar-bg); border-bottom: 1px solid var(--border);
  z-index: 1030; display: flex; align-items: center; padding: 0 1.5rem;
}
/* Main content */
#main-content { margin-left: var(--sidebar-w); padding-top: 60px; min-height: 100vh; }
.page-content { padding: 1.75rem; }
/* Cards */
.admin-card { background: #111; border: 1px solid var(--border); border-radius: .875rem; }
/* Stat card */
.stat-card { background: #111; border: 1px solid var(--border); border-radius: .875rem; padding: 1.5rem; }
.stat-card .stat-value { font-size: 2rem; font-weight: 700; color: var(--accent); }
.stat-card .stat-label { font-size: .8rem; color: rgba(255,255,255,.45); margin-top: .25rem; }
/* Accent button */
.btn-accent { background: var(--accent); color: #000; font-weight: 600; border: none; }
.btn-accent:hover { background: #d4e600; color: #000; }
/* Form */
.form-control, .form-select {
  background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.12);
  color: #fff; border-radius: .5rem;
}
.form-control:focus, .form-select:focus {
  background: rgba(255,255,255,.07); border-color: rgba(235,255,0,.4);
  color: #fff; box-shadow: 0 0 0 .2rem rgba(235,255,0,.1);
}
.form-label { color: rgba(255,255,255,.7); font-size: .85rem; font-weight: 500; }
/* Table */
.table-dark { --bs-table-bg: transparent; --bs-table-border-color: var(--border); }
/* Badge accent */
.badge-accent { background: rgba(235,255,0,.15); color: var(--accent); }
/* Breadcrumb */
.breadcrumb-item a { color: rgba(255,255,255,.45); text-decoration: none; }
.breadcrumb-item.active { color: rgba(255,255,255,.7); }
/* Mobile overlay toggle */
#sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.6); z-index: 1039; }
@media (max-width: 992px) {
  #sidebar { transform: translateX(-100%); }
  #sidebar.show { transform: translateX(0); }
  #topbar { left: 0; }
  #main-content { margin-left: 0; }
  #sidebar-overlay.show { display: block; }
}
</style>
</head>
<body>

<!-- Sidebar -->
<aside id="sidebar">
  <div class="brand">
    <div class="brand-name">Aeterna<span class="brand-dot">.</span> <small class="text-white-50 fw-normal" style="font-size:.7rem">Admin</small></div>
  </div>

  <nav class="py-2">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-grid-1x2"></i> Dashboard
    </a>
    <div class="px-3 py-1 mt-2" style="font-size:.7rem;color:rgba(255,255,255,.25);text-transform:uppercase;letter-spacing:.08em">Content</div>
    <a href="{{ route('admin.hero') }}" class="{{ request()->routeIs('admin.hero*') ? 'active' : '' }}">
      <i class="bi bi-stars"></i> Hero Section
    </a>
    <a href="{{ route('admin.navigation.index') }}" class="{{ request()->routeIs('admin.navigation*') ? 'active' : '' }}">
      <i class="bi bi-menu-button-wide"></i> Navigation
    </a>
    <a href="{{ route('admin.architecture.index') }}" class="{{ request()->routeIs('admin.architecture*') ? 'active' : '' }}">
      <i class="bi bi-layers"></i> Architecture
    </a>
    <a href="{{ route('admin.tokenomics') }}" class="{{ request()->routeIs('admin.tokenomics*') ? 'active' : '' }}">
      <i class="bi bi-coin"></i> Tokenomics
    </a>
    <a href="{{ route('admin.investors.index') }}" class="{{ request()->routeIs('admin.investors*') ? 'active' : '' }}">
      <i class="bi bi-building"></i> Investors
    </a>
    <a href="{{ route('admin.roadmap.index') }}" class="{{ request()->routeIs('admin.roadmap*') ? 'active' : '' }}">
      <i class="bi bi-map"></i> Roadmap
    </a>
    <a href="{{ route('admin.use-cases.index') }}" class="{{ request()->routeIs('admin.use-cases*') ? 'active' : '' }}">
      <i class="bi bi-briefcase"></i> Use Cases
    </a>
    <a href="{{ route('admin.footer-links.index') }}" class="{{ request()->routeIs('admin.footer-links*') ? 'active' : '' }}">
      <i class="bi bi-link-45deg"></i> Footer Links
    </a>
    <div class="px-3 py-1 mt-2" style="font-size:.7rem;color:rgba(255,255,255,.25);text-transform:uppercase;letter-spacing:.08em">System</div>
    <a href="{{ route('admin.subscribers.index') }}" class="{{ request()->routeIs('admin.subscribers*') ? 'active' : '' }}">
      <i class="bi bi-envelope-at"></i> Subscribers
    </a>
    <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
      <i class="bi bi-gear"></i> Settings
    </a>
    <a href="{{ route('home') }}" target="_blank">
      <i class="bi bi-box-arrow-up-right"></i> View Site
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="d-flex align-items-center gap-2">
      <div class="rounded-circle bg-white bg-opacity-10 d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:.75rem;color:#fff">
        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
      </div>
      <div>
        <div style="font-size:.8rem;color:#fff">{{ auth()->user()->name ?? 'Admin' }}</div>
        <div style="font-size:.7rem;color:rgba(255,255,255,.35)">Administrator</div>
      </div>
    </div>
  </div>
</aside>

<div id="sidebar-overlay"></div>

<!-- Topbar -->
<header id="topbar">
  <button id="sidebar-toggle" class="btn btn-sm btn-dark me-3 d-lg-none">
    <i class="bi bi-list fs-5"></i>
  </button>
  <nav aria-label="breadcrumb" class="me-auto">
    <ol class="breadcrumb mb-0" style="font-size:.82rem">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      @yield('breadcrumb')
    </ol>
  </nav>
  <form method="POST" action="{{ route('logout') }}" class="ms-3">
    @csrf
    <button type="submit" class="btn btn-sm" style="color:rgba(255,255,255,.45);font-size:.8rem">
      <i class="bi bi-box-arrow-right me-1"></i>Logout
    </button>
  </form>
</header>

<!-- Content -->
<main id="main-content">
  <div class="page-content">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show border-0 mb-4" style="background:rgba(34,197,94,.1);color:#4ade80;border-radius:.75rem" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" style="background:rgba(239,68,68,.1);color:#f87171;border-radius:.75rem" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @yield('content')
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggle = document.getElementById('sidebar-toggle');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
if (toggle) {
  toggle.addEventListener('click', () => { sidebar.classList.toggle('show'); overlay.classList.toggle('show'); });
  overlay.addEventListener('click', () => { sidebar.classList.remove('show'); overlay.classList.remove('show'); });
}
</script>
@yield('scripts')
</body>
</html>
