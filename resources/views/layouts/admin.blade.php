<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Admin ; @yield('title','Dashboard') | AeternaX</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
/* ── Wise Design Tokens ── */
:root {
  /* Brand */
  --wise-primary:        #9fe870;
  --wise-on-primary:     #0e0f0c;
  --wise-primary-active: #cdffad;
  --wise-primary-pale:   #e2f6d5;
  /* Surface */
  --wise-canvas:         #ffffff;
  --wise-canvas-soft:    #e8ebe6;
  /* Text */
  --wise-ink:            #0e0f0c;
  --wise-body:           #454745;
  --wise-mute:           #868685;
  /* Semantic */
  --wise-positive:       #2ead4b;
  --wise-positive-deep:  #054d28;
  --wise-warning:        #ffd11a;
  --wise-warning-content:#4a3b1c;
  --wise-negative:       #d03238;
  --wise-negative-bg:    #320707;
  /* Spacing */
  --wise-xs:  4px;
  --wise-sm:  8px;
  --wise-md:  12px;
  --wise-lg:  16px;
  --wise-xl:  24px;
  --wise-2xl: 32px;
  --wise-3xl: 48px;
  /* Radius */
  --wise-r-sm:   8px;
  --wise-r-md:   12px;
  --wise-r-lg:   16px;
  --wise-r-xl:   24px;
  --wise-r-pill: 9999px;
  /* Layout */
  --sidebar-w: 260px;
}

/* ── Base ── */
body {
  background: var(--wise-canvas-soft);
  font-family: Inter, system-ui, -apple-system, sans-serif;
  color: var(--wise-ink);
}

/* ── Sidebar (Wise dark surface ; card-feature-dark pattern) ── */
#sidebar {
  position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-w);
  background: var(--wise-ink);
  border-right: none;
  z-index: 1040; overflow-y: auto; transition: transform .3s;
  display: flex; flex-direction: column;
}
#sidebar .brand {
  padding: var(--wise-xl) var(--wise-xl);
  border-bottom: 1px solid rgba(255,255,255,.08);
}
#sidebar .brand-name {
  color: #fff; font-weight: 700; font-size: 1.05rem; letter-spacing: -.02em;
}
#sidebar .brand-dot { color: var(--wise-primary); }

/* Nav sections label */
#sidebar .nav-label {
  font-size: .68rem; color: rgba(255,255,255,.3);
  text-transform: uppercase; letter-spacing: .1em;
  padding: var(--wise-sm) var(--wise-xl) var(--wise-xs);
  margin-top: var(--wise-sm);
}
#sidebar nav a {
  display: flex; align-items: center; gap: .75rem;
  padding: var(--wise-sm) var(--wise-lg);
  margin: 2px var(--wise-sm);
  color: rgba(255,255,255,.55); text-decoration: none;
  font-size: .85rem; font-weight: 500;
  border-radius: var(--wise-r-sm);
  transition: color .15s, background .15s;
}
#sidebar nav a:hover {
  color: #fff; background: rgba(255,255,255,.07);
}
#sidebar nav a.active {
  color: var(--wise-ink); background: var(--wise-primary);
  font-weight: 600;
}
#sidebar nav a i { font-size: 1rem; width: 1.15rem; flex-shrink: 0; }
#sidebar .sidebar-footer {
  margin-top: auto;
  padding: var(--wise-lg) var(--wise-xl);
  border-top: 1px solid rgba(255,255,255,.08);
}

/* ── Topbar (Wise nav-bar ; white surface) ── */
#topbar {
  position: fixed; top: 0; left: var(--sidebar-w); right: 0; height: 60px;
  background: var(--wise-canvas);
  border-bottom: 1px solid var(--wise-canvas-soft);
  z-index: 1030; display: flex; align-items: center; padding: 0 var(--wise-xl);
}

/* ── Main content ── */
#main-content { margin-left: var(--sidebar-w); padding-top: 60px; min-height: 100vh; }
.page-content { padding: var(--wise-2xl); }

/* ── Admin Card (Wise card-content) ── */
.admin-card {
  background: var(--wise-canvas);
  border: none;
  border-radius: var(--wise-r-xl);
  box-shadow: 0 1px 3px rgba(14,15,12,.06), 0 4px 16px rgba(14,15,12,.04);
}

/* ── Stat Card ── */
.stat-card {
  background: var(--wise-canvas);
  border: none;
  border-radius: var(--wise-r-xl);
  padding: var(--wise-xl);
  box-shadow: 0 1px 3px rgba(14,15,12,.06), 0 4px 16px rgba(14,15,12,.04);
}
.stat-card .stat-value {
  font-size: 2rem; font-weight: 700; color: var(--wise-ink);
}
.stat-card .stat-label {
  font-size: .8rem; color: var(--wise-mute); margin-top: .25rem;
}
.stat-card .stat-icon {
  color: var(--wise-primary); font-size: 1.4rem; margin-top: var(--wise-sm);
}

/* ── Primary Button (Wise button-primary) ── */
.btn-accent {
  background: var(--wise-primary);
  color: var(--wise-on-primary);
  font-weight: 600; font-size: .9rem;
  border: none;
  border-radius: var(--wise-r-xl);
  padding: var(--wise-sm) var(--wise-xl);
  transition: background .15s;
}
.btn-accent:hover, .btn-accent:focus {
  background: var(--wise-primary-active);
  color: var(--wise-on-primary);
}

/* ── Secondary Button (Wise button-secondary) ── */
.btn-wise-secondary {
  background: var(--wise-canvas-soft);
  color: var(--wise-ink);
  font-weight: 600; font-size: .85rem;
  border: none;
  border-radius: var(--wise-r-xl);
  padding: 6px var(--wise-lg);
  transition: background .15s;
}
.btn-wise-secondary:hover {
  background: #d6dbd3;
  color: var(--wise-ink);
}

/* ── Tertiary / Outline Button (Wise button-tertiary) ── */
.btn-wise-outline {
  background: var(--wise-canvas);
  color: var(--wise-ink);
  font-weight: 600; font-size: .85rem;
  border: 1.5px solid var(--wise-ink);
  border-radius: var(--wise-r-xl);
  padding: 5px var(--wise-lg);
  transition: background .15s;
}
.btn-wise-outline:hover {
  background: var(--wise-canvas-soft);
  color: var(--wise-ink);
}

/* ── Danger Button ── */
.btn-wise-danger {
  background: transparent;
  color: var(--wise-negative);
  font-weight: 600; font-size: .85rem;
  border: 1.5px solid var(--wise-negative);
  border-radius: var(--wise-r-xl);
  padding: 5px var(--wise-lg);
  transition: background .15s, color .15s;
}
.btn-wise-danger:hover {
  background: var(--wise-negative);
  color: #fff;
}

/* ── Forms (Wise text-input) ── */
.form-control, .form-select {
  background: var(--wise-canvas);
  border: 1.5px solid rgba(14,15,12,.25);
  color: var(--wise-ink);
  border-radius: var(--wise-r-md);
  padding: var(--wise-md) var(--wise-lg);
  font-size: .9rem;
}
.form-control:focus, .form-select:focus {
  background: var(--wise-canvas);
  border-color: var(--wise-ink);
  color: var(--wise-ink);
  box-shadow: 0 0 0 3px rgba(159,232,112,.2);
}
.form-control::placeholder { color: var(--wise-mute); }
.form-label {
  color: var(--wise-body); font-size: .85rem; font-weight: 600; margin-bottom: 6px;
}
.form-check-label { color: var(--wise-body); font-size: .85rem; }
.form-check-input:checked {
  background-color: var(--wise-primary);
  border-color: var(--wise-primary);
}
.form-control-color { padding: var(--wise-xs) var(--wise-xs); height: 44px; }

/* ── Table (Wise ex-data-table-cell) ── */
.wise-table {
  --bs-table-bg: var(--wise-canvas);
  --bs-table-hover-bg: #f7f9f6;
  --bs-table-border-color: var(--wise-canvas-soft);
  color: var(--wise-ink);
  font-size: .85rem;
}
.wise-table thead th {
  background: var(--wise-canvas-soft);
  color: var(--wise-mute);
  font-size: .75rem; font-weight: 600;
  text-transform: uppercase; letter-spacing: .06em;
  border-bottom: none;
  padding: var(--wise-md) var(--wise-lg);
}
.wise-table thead th:first-child { border-radius: 0; }
.wise-table tbody td {
  padding: var(--wise-md) var(--wise-lg);
  vertical-align: middle;
  border-bottom: 1px solid var(--wise-canvas-soft);
  color: var(--wise-ink);
}
.wise-table tbody tr:last-child td { border-bottom: none; }
.wise-table .text-muted-cell { color: var(--wise-mute); }

/* ── Badges ── */
.wise-badge {
  font-size: .72rem; font-weight: 600;
  border-radius: var(--wise-r-pill);
  padding: var(--wise-xs) var(--wise-md);
  display: inline-block;
}
.wise-badge-primary {
  background: var(--wise-primary-pale);
  color: var(--wise-positive-deep);
}
.wise-badge-active {
  background: var(--wise-primary-pale);
  color: var(--wise-positive-deep);
}
.wise-badge-inactive {
  background: var(--wise-canvas-soft);
  color: var(--wise-mute);
}
.wise-badge-type {
  background: rgba(159,232,112,.18);
  color: var(--wise-ink-deep, #163300);
}
.wise-badge-stage {
  background: rgba(159,232,112,.15);
  color: var(--wise-positive-deep);
}
.wise-badge-warning {
  background: rgba(255,209,26,.2);
  color: var(--wise-warning-content);
}
.wise-badge-danger {
  background: rgba(208,50,56,.1);
  color: var(--wise-negative);
}

/* ── Breadcrumb ── */
.breadcrumb-item a { color: var(--wise-mute); text-decoration: none; font-size: .82rem; }
.breadcrumb-item a:hover { color: var(--wise-body); }
.breadcrumb-item.active { color: var(--wise-body); font-size: .82rem; }
.breadcrumb-item + .breadcrumb-item::before { color: var(--wise-mute); }

/* ── Alerts (Wise ex-toast tokens) ── */
.wise-alert {
  border: none;
  border-radius: var(--wise-r-lg);
  padding: var(--wise-md) var(--wise-xl);
  font-size: .9rem; font-weight: 500;
  display: flex; align-items: center; gap: var(--wise-sm);
}
.wise-alert-success {
  background: var(--wise-primary-pale);
  color: var(--wise-positive-deep);
}
.wise-alert-error {
  background: rgba(208,50,56,.08);
  color: var(--wise-negative);
}
.wise-alert .btn-close { margin-left: auto; opacity: .5; }

/* ── Quick link cards ── */
.quick-link-card {
  background: var(--wise-canvas);
  border: 1.5px solid var(--wise-canvas-soft);
  border-radius: var(--wise-r-xl);
  display: flex; align-items: center; gap: var(--wise-md);
  padding: var(--wise-lg);
  text-decoration: none;
  color: var(--wise-body);
  font-size: .85rem; font-weight: 500;
  transition: border-color .15s, box-shadow .15s;
}
.quick-link-card:hover {
  border-color: var(--wise-primary);
  box-shadow: 0 2px 12px rgba(159,232,112,.2);
  color: var(--wise-ink);
}
.quick-link-card i { color: var(--wise-primary); font-size: 1.15rem; flex-shrink: 0; }

/* ── Card divider ── */
.wise-card-header {
  padding: var(--wise-lg) var(--wise-xl);
  border-bottom: 1px solid var(--wise-canvas-soft);
  font-size: .95rem; font-weight: 600; color: var(--wise-ink);
}

/* ── Section heading ── */
.admin-section-title {
  font-size: 1.1rem; font-weight: 700; color: var(--wise-ink); margin-bottom: 0;
}

/* ── Sidebar overlay (mobile) ── */
#sidebar-overlay {
  display: none; position: fixed; inset: 0;
  background: rgba(14,15,12,.5); z-index: 1039;
}

/* ── Responsive ── */
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
    <div class="brand-name">Aeterna<span class="brand-dot">.</span> <small style="font-size:.68rem;color:rgba(255,255,255,.35);font-weight:400"> Admin</small></div>
  </div>

  <nav class="py-2">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-grid-1x2"></i> Dashboard
    </a>
    <div class="nav-label">Content</div>
    <a href="{{ route('admin.hero') }}" class="{{ request()->routeIs('admin.hero*') ? 'active' : '' }}">
      <i class="bi bi-stars"></i> Hero Section
    </a>
    <a href="{{ route('admin.navigation.index') }}" class="{{ request()->routeIs('admin.navigation*') ? 'active' : '' }}">
      <i class="bi bi-menu-button-wide"></i> Navigation
    </a>
    <a href="{{ route('admin.architecture.index') }}" class="{{ request()->routeIs('admin.architecture*') ? 'active' : '' }}">
      <i class="bi bi-layers"></i> Architecture
    </a>
    <a href="{{ route('admin.solutions.index') }}" class="{{ request()->routeIs('admin.solutions*') ? 'active' : '' }}">
      <i class="bi bi-table"></i> Solutions
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
    <a href="{{ route('admin.explorer.index') }}" class="{{ request()->routeIs('admin.explorer*') ? 'active' : '' }}">
      <i class="bi bi-search"></i> Explorer Pages
    </a>
    <div class="nav-label">System</div>
    <a href="{{ route('admin.subscribers.index') }}" class="{{ request()->routeIs('admin.subscribers*') ? 'active' : '' }}">
      <i class="bi bi-envelope-at"></i> Subscribers
    </a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
      <i class="bi bi-people"></i> Admin Users
    </a>
    <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
      <i class="bi bi-gear"></i> Settings
    </a>
    <a href="{{ route('home') }}" target="_blank">
      <i class="bi bi-box-arrow-up-right"></i> View Site
    </a>
  </nav>

  <div class="sidebar-footer">
    <a href="{{ route('admin.account.edit') }}" class="d-flex align-items-center gap-2 text-decoration-none">
      <div class="d-flex align-items-center justify-content-center fw-600"
           style="width:32px;height:32px;border-radius:var(--wise-r-pill);background:var(--wise-primary);color:var(--wise-on-primary);font-size:.8rem;font-weight:700;flex-shrink:0">
        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
      </div>
      <div>
        <div style="font-size:.82rem;color:#fff;font-weight:600">{{ auth()->user()->name ?? 'Admin' }}</div>
        <div style="font-size:.72rem;color:rgba(255,255,255,.35)">My Account</div>
      </div>
    </a>
  </div>
</aside>

<div id="sidebar-overlay"></div>

<!-- Topbar -->
<header id="topbar">
  <button id="sidebar-toggle" class="btn btn-sm d-lg-none me-3"
          style="background:var(--wise-canvas-soft);border:none;border-radius:var(--wise-r-sm);color:var(--wise-ink)">
    <i class="bi bi-list fs-5"></i>
  </button>
  <nav aria-label="breadcrumb" class="me-auto">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      @yield('breadcrumb')
    </ol>
  </nav>
  <form method="POST" action="{{ route('logout') }}" class="ms-3">
    @csrf
    <button type="submit" class="btn btn-wise-secondary btn-sm">
      <i class="bi bi-box-arrow-right me-1"></i>Logout
    </button>
  </form>
</header>

<!-- Content -->
<main id="main-content">
  <div class="page-content">
    @if(session('success'))
      <div class="wise-alert wise-alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="wise-alert wise-alert-error alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        {{ session('error') }}
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
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
