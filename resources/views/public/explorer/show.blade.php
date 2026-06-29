@extends('layouts.app')

@section('head')
<style>
/* ── Explorer Layout ── */
.explorer-wrap {
  display: flex;
  min-height: calc(100vh - 64px);
  background: #0D0D0D;
}

/* Sidebar */
.exp-sidebar {
  width: 240px;
  flex-shrink: 0;
  border-right: 1px solid rgba(255,255,255,0.06);
  padding: 2rem 0;
  position: sticky;
  top: 64px;
  height: calc(100vh - 64px);
  overflow-y: auto;
}
.exp-sidebar-label {
  font-size: .65rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.25);
  padding: .5rem 1.5rem .25rem;
  margin-top: .75rem;
}
.exp-sidebar a {
  display: flex;
  align-items: center;
  gap: .6rem;
  padding: .5rem 1.5rem;
  font-size: .82rem;
  font-weight: 500;
  color: rgba(255,255,255,0.5);
  text-decoration: none;
  border-left: 2px solid transparent;
  transition: color .15s, border-color .15s, background .15s;
}
.exp-sidebar a:hover {
  color: #fff;
  background: rgba(255,255,255,0.04);
}
.exp-sidebar a.active {
  color: #EBFF00;
  border-left-color: #EBFF00;
  background: rgba(235,255,0,0.06);
  font-weight: 600;
}
.exp-sidebar a svg { flex-shrink: 0; opacity: .7; }
.exp-sidebar a.active svg { opacity: 1; }

/* Main content */
.exp-main {
  flex: 1;
  min-width: 0;
  padding: 2rem 2.5rem;
  overflow-x: hidden;
}

/* Page header */
.exp-page-header {
  margin-bottom: 2rem;
}
.exp-page-header .exp-tag {
  display: inline-flex;
  align-items: center;
  gap: .4rem;
  font-size: .7rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: #EBFF00;
  background: rgba(235,255,0,0.08);
  border: 1px solid rgba(235,255,0,0.2);
  border-radius: 9999px;
  padding: .3rem .8rem;
  margin-bottom: .75rem;
}
.exp-page-header h1 {
  font-size: 1.6rem;
  font-weight: 800;
  color: #fff;
  letter-spacing: -.03em;
  margin: 0 0 .4rem;
}
.exp-page-header p {
  font-size: .9rem;
  color: rgba(255,255,255,0.45);
  margin: 0;
}

/* Glass card */
.exp-card {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 16px;
  padding: 1.5rem;
  margin-bottom: 1.25rem;
}
.exp-card-title {
  font-size: .75rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.3);
  margin-bottom: 1rem;
}

/* Stat grid */
.exp-stat-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: .75rem;
  margin-bottom: 1.25rem;
}
.exp-stat {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 12px;
  padding: 1rem 1.25rem;
}
.exp-stat.accent {
  background: rgba(235,255,0,0.06);
  border-color: rgba(235,255,0,0.2);
}
.exp-stat .sv {
  font-size: 1.4rem;
  font-weight: 800;
  color: #fff;
  letter-spacing: -.03em;
  line-height: 1.1;
}
.exp-stat.accent .sv { color: #EBFF00; }
.exp-stat .sl {
  font-size: .7rem;
  font-weight: 600;
  color: rgba(255,255,255,0.35);
  text-transform: uppercase;
  letter-spacing: .07em;
  margin-top: .25rem;
}
.exp-stat .ss {
  font-size: .72rem;
  color: rgba(255,255,255,0.3);
  margin-top: .2rem;
}

/* Table */
.exp-table {
  width: 100%;
  border-collapse: collapse;
  font-size: .82rem;
}
.exp-table th {
  text-align: left;
  font-size: .68rem;
  font-weight: 700;
  letter-spacing: .07em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.25);
  padding: .5rem .75rem;
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.exp-table td {
  padding: .65rem .75rem;
  border-bottom: 1px solid rgba(255,255,255,0.04);
  color: rgba(255,255,255,0.7);
  vertical-align: middle;
}
.exp-table tr:last-child td { border-bottom: none; }
.exp-table tr:hover td { background: rgba(255,255,255,0.02); }
.exp-table .mono { font-family: 'Fira Code', monospace; font-size: .78rem; color: rgba(255,255,255,0.55); }
.exp-table .bright { color: #fff; font-weight: 600; }

/* Status badge */
.exp-badge {
  display: inline-block;
  font-size: .67rem;
  font-weight: 700;
  border-radius: 9999px;
  padding: .2rem .65rem;
  text-transform: uppercase;
  letter-spacing: .05em;
}
.exp-badge-success  { background: rgba(159,232,112,0.12); color: #9FE870; border: 1px solid rgba(159,232,112,0.25); }
.exp-badge-pending  { background: rgba(235,255,0,0.1);    color: #EBFF00; border: 1px solid rgba(235,255,0,0.25); }
.exp-badge-routing  { background: rgba(96,165,250,0.1);   color: #60a5fa; border: 1px solid rgba(96,165,250,0.25); }
.exp-badge-challenge{ background: rgba(248,113,113,0.1);  color: #f87171; border: 1px solid rgba(248,113,113,0.25); }
.exp-badge-signed   { background: rgba(159,232,112,0.12); color: #9FE870; border: 1px solid rgba(159,232,112,0.25); }
.exp-badge-settled  { background: rgba(159,232,112,0.12); color: #9FE870; border: 1px solid rgba(159,232,112,0.25); }
.exp-badge-committed{ background: rgba(159,232,112,0.12); color: #9FE870; border: 1px solid rgba(159,232,112,0.25); }
.exp-badge-active   { background: rgba(159,232,112,0.12); color: #9FE870; border: 1px solid rgba(159,232,112,0.25); }
.exp-badge-low_stake{ background: rgba(235,255,0,0.1);    color: #EBFF00; border: 1px solid rgba(235,255,0,0.25); }

/* KV list */
.exp-kv { display: flex; flex-wrap: wrap; gap: .75rem 0; }
.exp-kv-row { display: flex; width: 100%; padding: .5rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
.exp-kv-row:last-child { border-bottom: none; }
.exp-kv-key { width: 200px; flex-shrink: 0; font-size: .75rem; font-weight: 600; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: .06em; padding-top: .1rem; }
.exp-kv-val { flex: 1; font-size: .85rem; color: rgba(255,255,255,0.8); font-family: 'Fira Code', monospace; word-break: break-all; }

/* Timeline */
.exp-timeline { position: relative; padding-left: 1.5rem; }
.exp-timeline::before { content:''; position:absolute; left: .4rem; top: .5rem; bottom: .5rem; width: 1px; background: rgba(255,255,255,0.08); }
.exp-tl-item { position: relative; margin-bottom: 1.25rem; }
.exp-tl-item:last-child { margin-bottom: 0; }
.exp-tl-dot { position: absolute; left: -1.5rem; top: .25rem; width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.exp-tl-label { font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; margin-bottom: .2rem; }
.exp-tl-desc { font-size: .82rem; color: rgba(255,255,255,0.5); }

/* Command steps */
.exp-steps { display: flex; flex-direction: column; gap: .75rem; }
.exp-step { display: flex; gap: 1rem; align-items: flex-start; }
.exp-step-num { width: 28px; height: 28px; border-radius: 50%; background: rgba(235,255,0,0.1); border: 1px solid rgba(235,255,0,0.25); color: #EBFF00; font-size: .72rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: .1rem; }
.exp-step-body .step-label { font-size: .82rem; font-weight: 700; color: #fff; font-family: 'Fira Code', monospace; margin-bottom: .2rem; }
.exp-step-body .step-desc  { font-size: .8rem; color: rgba(255,255,255,0.45); }

/* Rep score */
.exp-rep { display: inline-flex; align-items: center; gap: .4rem; }
.exp-rep-bar { width: 60px; height: 4px; background: rgba(255,255,255,0.1); border-radius: 9999px; overflow: hidden; }
.exp-rep-fill { height: 100%; background: #9FE870; border-radius: 9999px; }

/* 2-col grid */
.exp-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
@media (max-width: 900px) { .exp-2col { grid-template-columns: 1fr; } }

/* Network stats bar */
.exp-net-bar { display: flex; flex-wrap: wrap; gap: .75rem; margin-bottom: 1.25rem; }
.exp-net-stat { flex: 1; min-width: 120px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: .9rem 1.1rem; }
.exp-net-stat .nv { font-size: 1.15rem; font-weight: 800; color: #fff; letter-spacing: -.02em; }
.exp-net-stat .nl { font-size: .68rem; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: rgba(255,255,255,0.3); margin-top: .2rem; }

/* Light mode */
html:not(.dark) .explorer-wrap { background: #f5f4f0; }
html:not(.dark) .exp-sidebar { border-right-color: rgba(0,0,0,0.08); }
html:not(.dark) .exp-sidebar-label { color: rgba(0,0,0,0.3); }
html:not(.dark) .exp-sidebar a { color: rgba(0,0,0,0.5); }
html:not(.dark) .exp-sidebar a:hover { color: #1A1A1A; background: rgba(0,0,0,0.04); }
html:not(.dark) .exp-sidebar a.active { color: #4A8C2A; border-left-color: #4A8C2A; background: rgba(74,140,42,0.06); }
html:not(.dark) .exp-card { background: #fff; border-color: rgba(0,0,0,0.08); box-shadow: 0 1px 4px rgba(0,0,0,0.06); }
html:not(.dark) .exp-card-title { color: rgba(0,0,0,0.35); }
html:not(.dark) .exp-stat { background: #fff; border-color: rgba(0,0,0,0.08); }
html:not(.dark) .exp-stat .sv { color: #1A1A1A; }
html:not(.dark) .exp-stat.accent { background: rgba(74,140,42,0.06); border-color: rgba(74,140,42,0.2); }
html:not(.dark) .exp-stat.accent .sv { color: #4A8C2A; }
html:not(.dark) .exp-stat .sl { color: rgba(0,0,0,0.35); }
html:not(.dark) .exp-stat .ss { color: rgba(0,0,0,0.3); }
html:not(.dark) .exp-table th { color: rgba(0,0,0,0.35); border-bottom-color: rgba(0,0,0,0.08); }
html:not(.dark) .exp-table td { color: rgba(0,0,0,0.65); border-bottom-color: rgba(0,0,0,0.05); }
html:not(.dark) .exp-table .mono { color: rgba(0,0,0,0.45); }
html:not(.dark) .exp-table .bright { color: #1A1A1A; }
html:not(.dark) .exp-page-header h1 { color: #1A1A1A; }
html:not(.dark) .exp-page-header p { color: rgba(0,0,0,0.45); }
html:not(.dark) .exp-page-header .exp-tag { color: #4A8C2A; background: rgba(74,140,42,0.08); border-color: rgba(74,140,42,0.2); }
html:not(.dark) .exp-kv-key { color: rgba(0,0,0,0.35); }
html:not(.dark) .exp-kv-val { color: #1A1A1A; }
html:not(.dark) .exp-kv-row { border-bottom-color: rgba(0,0,0,0.06); }
html:not(.dark) .exp-tl-desc { color: rgba(0,0,0,0.5); }
html:not(.dark) .exp-timeline::before { background: rgba(0,0,0,0.1); }
html:not(.dark) .exp-step-body .step-desc { color: rgba(0,0,0,0.45); }
html:not(.dark) .exp-net-stat { background: #fff; border-color: rgba(0,0,0,0.08); }
html:not(.dark) .exp-net-stat .nv { color: #1A1A1A; }
html:not(.dark) .exp-net-stat .nl { color: rgba(0,0,0,0.35); }
</style>
@endsection

@section('content')
@php $c = $page->content_json ?? []; @endphp

<div class="explorer-wrap">

  {{-- ── Sidebar ── --}}
  <aside class="exp-sidebar hidden lg:block">
    <div class="exp-sidebar-label">{{ __('messages.explorer.nav.core') }}</div>
    <a href="{{ route('explorer.show', 'dashboard') }}" class="{{ $page->slug === 'dashboard' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
      {{ __('messages.explorer.nav.dashboard') }}
    </a>
    <a href="{{ route('explorer.show', 'checkpoint') }}" class="{{ $page->slug === 'checkpoint' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/></svg>
      {{ __('messages.explorer.nav.checkpoints') }}
    </a>
    <a href="{{ route('explorer.show', 'transaction') }}" class="{{ $page->slug === 'transaction' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
      {{ __('messages.explorer.nav.transactions') }}
    </a>
    <a href="{{ route('explorer.show', 'account') }}" class="{{ $page->slug === 'account' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
      {{ __('messages.explorer.nav.accounts') }}
    </a>
    <a href="{{ route('explorer.show', 'validators') }}" class="{{ $page->slug === 'validators' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      {{ __('messages.explorer.nav.validators') }}
    </a>

    <div class="exp-sidebar-label">{{ __('messages.explorer.nav.ai_native') }}</div>
    <a href="{{ route('explorer.show', 'agent') }}" class="{{ $page->slug === 'agent' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
      {{ __('messages.explorer.nav.agents') }}
    </a>
    <a href="{{ route('explorer.show', 'skills') }}" class="{{ $page->slug === 'skills' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
      {{ __('messages.explorer.nav.skills') }}
    </a>
    <a href="{{ route('explorer.show', 'crosschain') }}" class="{{ $page->slug === 'crosschain' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
      {{ __('messages.explorer.nav.crosschain') }}
    </a>
  </aside>

  {{-- ── Main ── --}}
  <main class="exp-main">

    {{-- Page header --}}
    <div class="exp-page-header">
      <div class="exp-tag">{{ $page->tag }}</div>
      <h1>{{ $page->title }}</h1>
      <p>{{ $page->description }}</p>
    </div>

    {{-- ── Slug-specific content ── --}}

    @switch($page->slug)

    {{-- ────── DASHBOARD ────── --}}
    @case('dashboard')
      <div class="exp-stat-grid">
        @foreach($c['hero_stats'] ?? [] as $s)
        <div class="exp-stat {{ !empty($s['accent']) ? 'accent' : '' }}">
          <div class="sv">{{ $s['value'] }}</div>
          <div class="sl">{{ $s['label'] }}</div>
          <div class="ss">{{ $s['sub'] }}</div>
        </div>
        @endforeach
      </div>

      <div class="exp-2col">
        <div class="exp-card">
          <div class="exp-card-title">{{ __('messages.explorer.dashboard.recent_checkpoints') }}</div>
          <table class="exp-table">
            <thead><tr>
              <th>{{ __('messages.explorer.dashboard.th_sequence') }}</th>
              <th>{{ __('messages.explorer.dashboard.th_txns') }}</th>
              <th>{{ __('messages.explorer.nav.validators') }}</th>
              <th>{{ __('messages.explorer.common.time') }}</th>
            </tr></thead>
            <tbody>
              @foreach($c['recent_checkpoints'] ?? [] as $row)
              <tr>
                <td><a href="{{ route('explorer.show', 'checkpoint') }}" class="mono" style="color:#EBFF00;text-decoration:none">{{ $row['seq'] }}</a></td>
                <td class="bright">{{ $row['txns'] }}</td>
                <td class="mono">{{ $row['validators'] }}</td>
                <td class="mono">{{ $row['ago'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="exp-card">
          <div class="exp-card-title">{{ __('messages.explorer.dashboard.recent_transactions') }}</div>
          <table class="exp-table">
            <thead><tr>
              <th>{{ __('messages.explorer.common.hash') }}</th>
              <th>{{ __('messages.explorer.common.type') }}</th>
              <th>{{ __('messages.explorer.common.gas') }}</th>
              <th>{{ __('messages.explorer.common.status') }}</th>
            </tr></thead>
            <tbody>
              @foreach($c['recent_transactions'] ?? [] as $row)
              <tr>
                <td><a href="{{ route('explorer.show', 'transaction') }}" class="mono" style="color:#EBFF00;text-decoration:none">{{ $row['hash'] }}</a></td>
                <td>{{ $row['type'] }}</td>
                <td class="mono">{{ $row['gas'] }}</td>
                <td><span class="exp-badge exp-badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.dashboard.ai_subsystems') }}</div>
        <div class="exp-stat-grid">
          @foreach($c['ai_subsystems'] ?? [] as $s)
          <div class="exp-stat">
            <div class="sv">{{ $s['value'] }}</div>
            <div class="sl">{{ $s['label'] }}</div>
            <div class="ss">{{ $s['sub'] }}</div>
          </div>
          @endforeach
        </div>
      </div>
    @break

    {{-- ────── CHECKPOINT ────── --}}
    @case('checkpoint')
      @php $ov = $c['overview'] ?? []; @endphp
      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.checkpoint.overview') }}</div>
        <div class="exp-kv">
          @foreach([
            ['label' => __('messages.explorer.nav.checkpoints'),               'val' => $ov['checkpoint'] ?? ''],
            ['label' => __('messages.explorer.validators.current_epoch'),       'val' => $ov['sequence'] ?? ''],
            ['label' => __('messages.explorer.common.status'),                  'val' => $ov['status'] ?? '',     'badge' => true],
            ['label' => __('messages.explorer.common.digest'),                  'val' => $ov['digest'] ?? ''],
            ['label' => __('messages.explorer.checkpoint.kv_previous_digest'),  'val' => $ov['previous_digest'] ?? ''],
            ['label' => __('messages.explorer.common.timestamp'),               'val' => $ov['timestamp'] ?? ''],
            ['label' => __('messages.explorer.nav.transactions'),               'val' => $ov['tx_count'] ?? ''],
            ['label' => __('messages.explorer.checkpoint.kv_gas_computation'),  'val' => $ov['gas_computation'] ?? ''],
            ['label' => __('messages.explorer.checkpoint.kv_gas_storage'),      'val' => $ov['gas_storage'] ?? ''],
            ['label' => __('messages.explorer.checkpoint.kv_validator_sigs'),   'val' => $ov['validator_sigs'] ?? ''],
          ] as $row)
          <div class="exp-kv-row">
            <div class="exp-kv-key">{{ $row['label'] }}</div>
            <div class="exp-kv-val">
              @if(!empty($row['badge']))
                <span class="exp-badge exp-badge-{{ strtolower($row['val']) }}">{{ $row['val'] }}</span>
              @else
                {{ $row['val'] }}
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.nav.transactions') }} ({{ count($c['transactions'] ?? []) }})</div>
        <table class="exp-table">
          <thead><tr>
            <th>{{ __('messages.explorer.common.digest') }}</th>
            <th>{{ __('messages.explorer.common.type') }}</th>
            <th>{{ __('messages.explorer.common.sender') }}</th>
            <th>{{ __('messages.explorer.common.gas') }}</th>
            <th>{{ __('messages.explorer.common.status') }}</th>
          </tr></thead>
          <tbody>
            @foreach($c['transactions'] ?? [] as $tx)
            <tr>
              <td class="mono">{{ $tx['digest'] }}</td>
              <td>{{ $tx['type'] }}</td>
              <td class="mono">{{ $tx['sender'] }}</td>
              <td class="mono">{{ $tx['gas'] }}</td>
              <td><span class="exp-badge exp-badge-{{ $tx['status'] }}">{{ $tx['status'] }}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @break

    {{-- ────── TRANSACTION ────── --}}
    @case('transaction')
      @php $ov = $c['overview'] ?? []; @endphp
      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.transaction.overview') }}</div>
        <div class="exp-kv">
          @foreach([
            ['label' => __('messages.explorer.transaction.kv_id'),             'val' => $ov['id'] ?? ''],
            ['label' => __('messages.explorer.common.status'),                  'val' => $ov['status'] ?? '',     'badge' => true],
            ['label' => __('messages.explorer.common.sender'),                  'val' => $ov['sender'] ?? ''],
            ['label' => __('messages.explorer.nav.checkpoints'),               'val' => $ov['checkpoint'] ?? ''],
            ['label' => __('messages.explorer.common.timestamp'),               'val' => $ov['timestamp'] ?? ''],
            ['label' => __('messages.explorer.transaction.kv_gas_total'),       'val' => $ov['gas_total'] ?? ''],
            ['label' => __('messages.explorer.checkpoint.kv_gas_computation'),  'val' => $ov['gas_computation'] ?? ''],
            ['label' => __('messages.explorer.checkpoint.kv_gas_storage'),      'val' => $ov['gas_storage'] ?? ''],
            ['label' => __('messages.explorer.transaction.kv_execution'),       'val' => $ov['execution'] ?? ''],
          ] as $row)
          <div class="exp-kv-row">
            <div class="exp-kv-key">{{ $row['label'] }}</div>
            <div class="exp-kv-val">
              @if(!empty($row['badge']))
                <span class="exp-badge exp-badge-{{ strtolower($row['val']) }}">{{ $row['val'] }}</span>
              @else
                {{ $row['val'] }}
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="exp-2col">
        <div class="exp-card">
          <div class="exp-card-title">{{ __('messages.explorer.transaction.ptb_commands') }}</div>
          <div class="exp-steps">
            @foreach($c['commands'] ?? [] as $cmd)
            <div class="exp-step">
              <div class="exp-step-num">{{ $cmd['n'] }}</div>
              <div class="exp-step-body">
                <div class="step-label">{{ $cmd['label'] }}</div>
                <div class="step-desc">{{ $cmd['desc'] }}</div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div>
          <div class="exp-card">
            <div class="exp-card-title">{{ __('messages.explorer.transaction.object_changes') }}</div>
            @if(!empty($c['object_changes']['mutated']))
            <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:rgba(255,255,255,0.3);margin-bottom:.5rem">{{ __('messages.explorer.transaction.mutated') }}</div>
            @foreach($c['object_changes']['mutated'] as $obj)
            <div style="display:flex;justify-content:space-between;padding:.4rem 0;border-bottom:1px solid rgba(255,255,255,0.05)">
              <span style="font-size:.82rem;color:rgba(255,255,255,0.7)">{{ $obj['label'] }}</span>
              <span class="mono" style="font-size:.75rem">{{ $obj['addr'] }}</span>
            </div>
            @endforeach
            @endif
            @if(!empty($c['object_changes']['created']))
            <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:rgba(255,255,255,0.3);margin:.75rem 0 .5rem">{{ __('messages.explorer.transaction.created') }}</div>
            @foreach($c['object_changes']['created'] as $obj)
            <div style="display:flex;justify-content:space-between;padding:.4rem 0;border-bottom:1px solid rgba(255,255,255,0.05)">
              <span style="font-size:.82rem;color:rgba(255,255,255,0.7)">{{ $obj['label'] }}</span>
              <span class="mono" style="font-size:.75rem">{{ $obj['addr'] }}</span>
            </div>
            @endforeach
            @endif
          </div>

          <div class="exp-card">
            <div class="exp-card-title">{{ __('messages.explorer.transaction.events') }}</div>
            @foreach($c['events'] ?? [] as $ev)
            <div style="padding:.5rem 0;border-bottom:1px solid rgba(255,255,255,0.05)">
              <div style="font-size:.82rem;font-weight:700;color:#EBFF00;font-family:'Fira Code',monospace;margin-bottom:.2rem">{{ $ev['name'] }}</div>
              <div style="font-size:.8rem;color:rgba(255,255,255,0.5)">{{ $ev['desc'] }}</div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    @break

    {{-- ────── AGENT ────── --}}
    @case('agent')
      @php $id = $c['identity'] ?? []; @endphp
      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.agent.identity') }}</div>
        <div style="display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;margin-bottom:1.25rem">
          <div style="width:56px;height:56px;border-radius:14px;background:rgba(235,255,0,0.1);border:1px solid rgba(235,255,0,0.25);display:flex;align-items:center;justify-content:center;color:#EBFF00;flex-shrink:0">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
          </div>
          <div>
            <div style="font-size:1.2rem;font-weight:800;color:#fff;letter-spacing:-.02em">{{ $id['name'] ?? '' }}</div>
            <div class="mono" style="font-size:.78rem;color:rgba(255,255,255,0.4);margin-top:.2rem">{{ $id['address'] ?? '' }}</div>
          </div>
          <div style="margin-left:auto;text-align:right">
            <div style="font-size:1.6rem;font-weight:800;color:#9FE870;letter-spacing:-.03em">{{ $id['reputation'] ?? '' }}</div>
            <div style="font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:rgba(255,255,255,0.3)">{{ __('messages.explorer.agent.reputation') }}</div>
          </div>
        </div>
        <div class="exp-stat-grid">
          <div class="exp-stat"><div class="sv">{{ $id['total_skills'] ?? '' }}</div><div class="sl">{{ __('messages.explorer.agent.total_skills') }}</div></div>
          <div class="exp-stat"><div class="sv">{{ $id['self_evolved'] ?? '' }}</div><div class="sl">{{ __('messages.explorer.agent.self_evolved') }}</div></div>
          <div class="exp-stat"><div class="sv">{{ $id['lifetime_royalties'] ?? '' }}</div><div class="sl">{{ __('messages.explorer.agent.lifetime_royalties') }}</div></div>
          <div class="exp-stat"><div class="sv">{{ $id['royalties_24h'] ?? '' }}</div><div class="sl">{{ __('messages.explorer.agent.last_24h') }}</div></div>
          <div class="exp-stat"><div class="sv">{{ $id['active_collaborations'] ?? '' }}</div><div class="sl">{{ __('messages.explorer.agent.collaborations') }}</div></div>
          <div class="exp-stat"><div class="sv">{{ $id['total_citations'] ?? '' }}</div><div class="sl">{{ __('messages.explorer.agent.citations') }}</div></div>
        </div>
      </div>

      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.agent.skill_portfolio') }}</div>
        <table class="exp-table">
          <thead><tr>
            <th>{{ __('messages.explorer.skills.th_skill') }}</th>
            <th>{{ __('messages.explorer.agent.th_invocations') }}</th>
            <th>{{ __('messages.explorer.agent.reputation') }}</th>
            <th>{{ __('messages.explorer.agent.reputation') }}</th>
            <th>{{ __('messages.explorer.agent.th_lineage') }}</th>
          </tr></thead>
          <tbody>
            @foreach($c['skills'] ?? [] as $sk)
            <tr>
              <td class="bright" style="font-family:'Fira Code',monospace">{{ $sk['name'] }}</td>
              <td>{{ $sk['invocations'] }}</td>
              <td style="color:#9FE870;font-weight:600">{{ $sk['royalties'] }}</td>
              <td>
                <div class="exp-rep">
                  <span style="font-size:.82rem;font-weight:700;color:#fff">{{ $sk['rep'] }}</span>
                  <div class="exp-rep-bar"><div class="exp-rep-fill" style="width:{{ $sk['rep'] }}%"></div></div>
                </div>
              </td>
              <td>
                @if(!empty($sk['evolved']))
                  <span class="exp-badge" style="background:rgba(167,139,250,0.1);color:#a78bfa;border:1px solid rgba(167,139,250,0.25)">{{ __('messages.explorer.agent.evolved_from') }} {{ $sk['parent'] ?? '' }}</span>
                @else
                  <span style="color:rgba(255,255,255,0.25);font-size:.78rem">{{ __('messages.explorer.agent.original') }}</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.agent.collaborations') }}</div>
        @foreach($c['collaborations'] ?? [] as $col)
        <div style="display:flex;align-items:center;justify-content:space-between;padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,0.05)">
          <div>
            <div style="font-size:.85rem;font-weight:700;color:#fff">{{ $col['partner'] }}</div>
            <div style="font-size:.75rem;color:rgba(255,255,255,0.4)">{{ $col['share'] }}</div>
          </div>
          <span class="exp-badge" style="background:rgba(96,165,250,0.1);color:#60a5fa;border:1px solid rgba(96,165,250,0.25)">{{ $col['type'] }}</span>
        </div>
        @endforeach
      </div>
    @break

    {{-- ────── CROSSCHAIN ────── --}}
    @case('crosschain')
      @php $acc = $c['account'] ?? []; @endphp
      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.crosschain.account_summary') }}</div>
        <div class="exp-stat-grid">
          <div class="exp-stat accent">
            <div class="sv">{{ $acc['total_value'] ?? '' }}</div>
            <div class="sl">{{ __('messages.explorer.crosschain.total_value') }}</div>
          </div>
          <div class="exp-stat">
            <div class="sv mono" style="font-size:1rem">{{ $acc['address'] ?? '' }}</div>
            <div class="sl">{{ __('messages.explorer.crosschain.aeterna_address') }}</div>
          </div>
          <div class="exp-stat">
            <div class="sv">{{ $acc['tss_nodes'] ?? '' }}</div>
            <div class="sl">{{ __('messages.explorer.crosschain.tss_nodes') }}</div>
          </div>
          <div class="exp-stat">
            <div class="sv" style="font-size:.9rem">{{ $acc['scheme'] ?? '' }}</div>
            <div class="sl">{{ __('messages.explorer.crosschain.signing_scheme') }}</div>
          </div>
        </div>
      </div>

      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.crosschain.derived_addresses') }}</div>
        <table class="exp-table">
          <thead><tr>
            <th>{{ __('messages.explorer.crosschain.th_chain') }}</th>
            <th>{{ __('messages.explorer.common.address') }}</th>
            <th>{{ __('messages.explorer.crosschain.th_balance') }}</th>
            <th>{{ __('messages.explorer.crosschain.th_value') }}</th>
            <th>{{ __('messages.explorer.crosschain.th_trust_model') }}</th>
          </tr></thead>
          <tbody>
            @foreach($c['chains'] ?? [] as $ch)
            <tr>
              <td class="bright">{{ $ch['chain'] }}</td>
              <td class="mono">{{ $ch['address'] }}</td>
              <td class="bright">{{ $ch['balance'] }}</td>
              <td style="color:#9FE870;font-weight:600">{{ $ch['value'] }}</td>
              <td><span class="exp-badge" style="background:rgba(96,165,250,0.1);color:#60a5fa;border:1px solid rgba(96,165,250,0.25)">{{ $ch['trust'] }}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="exp-2col">
        <div class="exp-card">
          <div class="exp-card-title">{{ __('messages.explorer.crosschain.intents') }}</div>
          <table class="exp-table">
            <thead><tr>
              <th>{{ __('messages.explorer.crosschain.th_intent') }}</th>
              <th>{{ __('messages.explorer.crosschain.th_solver') }}</th>
              <th>{{ __('messages.explorer.crosschain.th_fee') }}</th>
              <th>{{ __('messages.explorer.common.time') }}</th>
              <th>{{ __('messages.explorer.common.status') }}</th>
            </tr></thead>
            <tbody>
              @foreach($c['intents'] ?? [] as $intent)
              <tr>
                <td>{{ $intent['desc'] }}</td>
                <td class="mono">{{ $intent['solver'] }}</td>
                <td class="mono">{{ $intent['fee'] }}</td>
                <td class="mono">{{ $intent['time'] }}</td>
                <td><span class="exp-badge exp-badge-{{ $intent['status'] }}">{{ $intent['status'] }}</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="exp-card">
          <div class="exp-card-title">{{ __('messages.explorer.crosschain.mpc_activity') }}</div>
          <table class="exp-table">
            <thead><tr>
              <th>{{ __('messages.explorer.common.transaction') }}</th>
              <th>{{ __('messages.explorer.crosschain.th_approval') }}</th>
              <th>{{ __('messages.explorer.crosschain.th_attest') }}</th>
              <th>{{ __('messages.explorer.common.status') }}</th>
            </tr></thead>
            <tbody>
              @foreach($c['mpc_activity'] ?? [] as $mpc)
              <tr>
                <td>{{ $mpc['tx'] }}@if(!empty($mpc['remaining'])) <span style="color:rgba(255,255,255,0.3);font-size:.75rem"> ({{ $mpc['remaining'] }})</span>@endif</td>
                <td class="mono">{{ $mpc['approval'] }}</td>
                <td><span class="exp-badge" style="background:rgba(167,139,250,0.1);color:#a78bfa;border:1px solid rgba(167,139,250,0.25)">{{ $mpc['attestation'] }}</span></td>
                <td><span class="exp-badge exp-badge-{{ $mpc['status'] }}">{{ $mpc['status'] }}</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @break

    {{-- ────── SKILLS ────── --}}
    @case('skills')
      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.skills.market') }}</div>
        <table class="exp-table">
          <thead><tr>
            <th>{{ __('messages.explorer.skills.th_skill') }}</th>
            <th>{{ __('messages.explorer.skills.th_creator') }}</th>
            <th>{{ __('messages.explorer.skills.th_calls') }}</th>
            <th>{{ __('messages.explorer.agent.lifetime_royalties') }}</th>
            <th>{{ __('messages.explorer.agent.reputation') }}</th>
          </tr></thead>
          <tbody>
            @foreach($c['market'] ?? [] as $sk)
            <tr>
              <td class="bright" style="font-family:'Fira Code',monospace">{{ $sk['name'] }}</td>
              <td class="mono">{{ $sk['creator'] }}</td>
              <td>{{ $sk['calls'] }}</td>
              <td style="color:#9FE870;font-weight:600">{{ $sk['royalties'] }}</td>
              <td>
                <div class="exp-rep">
                  <span style="font-size:.82rem;font-weight:700;color:#fff">{{ $sk['rep'] }}</span>
                  <div class="exp-rep-bar"><div class="exp-rep-fill" style="width:{{ $sk['rep'] }}%"></div></div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @php $cap = $c['capsule'] ?? []; @endphp
      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.skills.capsule_lineage') }}</div>
        <div style="display:flex;gap:2rem;flex-wrap:wrap;margin-bottom:1.25rem">
          <div><div class="mono" style="font-size:.82rem;color:rgba(255,255,255,0.5)">{{ $cap['address'] ?? '' }}</div><div style="font-size:.68rem;color:rgba(255,255,255,0.25);text-transform:uppercase;letter-spacing:.07em">{{ __('messages.explorer.skills.capsule_address') }}</div></div>
          <div><div style="font-size:.9rem;font-weight:700;color:#fff">{{ $cap['versions'] ?? '' }} {{ __('messages.explorer.skills.versions') }}</div><div style="font-size:.68rem;color:rgba(255,255,255,0.25);text-transform:uppercase;letter-spacing:.07em">{{ __('messages.explorer.skills.history') }}</div></div>
          <div><div style="font-size:.9rem;font-weight:700;color:#EBFF00">{{ $cap['encryption'] ?? '' }}</div><div style="font-size:.68rem;color:rgba(255,255,255,0.25);text-transform:uppercase;letter-spacing:.07em">{{ __('messages.explorer.skills.encryption') }}</div></div>
        </div>
        <div class="exp-timeline">
          @foreach($cap['timeline'] ?? [] as $ev)
          <div class="exp-tl-item">
            <div class="exp-tl-dot" style="background:{{ $ev['color'] }}"></div>
            <div class="exp-tl-label" style="color:{{ $ev['color'] }}">{{ $ev['event'] }}</div>
            <div class="exp-tl-desc">{{ $ev['desc'] }}</div>
          </div>
          @endforeach
        </div>
      </div>
    @break

    {{-- ────── ACCOUNT ────── --}}
    @case('account')
      @php $id = $c['identity'] ?? []; @endphp
      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.account.identity') }}</div>
        <div class="exp-kv">
          @foreach([
            ['label' => __('messages.explorer.common.address'),                    'val' => $id['address'] ?? ''],
            ['label' => __('messages.explorer.account.kv_ata_balance'),             'val' => ($id['ata_balance'] ?? '') . ' ATA'],
            ['label' => __('messages.explorer.agent.lifetime_royalties'),           'val' => $id['lifetime_royalties'] ?? ''],
            ['label' => __('messages.explorer.common.status'),                      'val' => $id['status'] ?? ''],
            ['label' => __('messages.explorer.account.kv_first_activity'),          'val' => $id['first_activity'] ?? ''],
            ['label' => __('messages.explorer.account.kv_total_transactions'),      'val' => $id['tx_count'] ?? ''],
            ['label' => __('messages.explorer.account.kv_crosschain_deployments'),  'val' => $id['cross_chain_deployments'] ?? ''],
            ['label' => __('messages.explorer.account.kv_owned_objects'),           'val' => ($id['object_count'] ?? '') . ' (' . ($id['object_types'] ?? '') . ' types)'],
          ] as $row)
          <div class="exp-kv-row">
            <div class="exp-kv-key">{{ $row['label'] }}</div>
            <div class="exp-kv-val">{{ $row['val'] }}</div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="exp-2col">
        <div class="exp-card">
          <div class="exp-card-title">{{ __('messages.explorer.account.owned_objects') }}</div>
          @foreach($c['objects'] ?? [] as $obj)
          <div style="display:flex;align-items:center;justify-content:space-between;padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,0.05)">
            <div>
              <div style="font-size:.85rem;font-weight:700;color:#fff">{{ $obj['type'] }}</div>
              <div style="font-size:.75rem;color:rgba(255,255,255,0.4)">{{ $obj['detail'] }}</div>
            </div>
            <div style="font-size:1.1rem;font-weight:800;color:#EBFF00">{{ $obj['count'] }}</div>
          </div>
          @endforeach
        </div>

        <div class="exp-card">
          <div class="exp-card-title">{{ __('messages.explorer.dashboard.recent_transactions') }}</div>
          @foreach($c['transactions'] ?? [] as $tx)
          <div style="display:flex;align-items:center;justify-content:space-between;padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,0.05)">
            <div>
              <div style="font-size:.82rem;font-weight:600;color:#fff">{{ $tx['type'] }}</div>
              <div style="font-size:.73rem;color:rgba(255,255,255,0.3)">{{ $tx['ago'] }}</div>
            </div>
            <div style="text-align:right">
              <div style="font-size:.85rem;font-weight:700;color:{{ str_starts_with($tx['amount'], '+') ? '#9FE870' : (str_starts_with($tx['amount'], '-') ? '#f87171' : 'rgba(255,255,255,0.5)') }}">{{ $tx['amount'] }}</div>
              <span class="exp-badge exp-badge-{{ $tx['status'] }}">{{ $tx['status'] }}</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    @break

    {{-- ────── VALIDATORS ────── --}}
    @case('validators')
      @php $net = $c['network'] ?? []; @endphp
      <div class="exp-net-bar">
        <div class="exp-net-stat"><div class="nv">{{ $net['epoch'] ?? '' }}</div><div class="nl">{{ __('messages.explorer.validators.current_epoch') }}</div></div>
        <div class="exp-net-stat"><div class="nv">{{ $net['active_validators'] ?? '' }}</div><div class="nl">{{ __('messages.explorer.validators.active_validators') }}</div></div>
        <div class="exp-net-stat"><div class="nv">{{ $net['total_stake'] ?? '' }}</div><div class="nl">{{ __('messages.explorer.validators.total_stake') }}</div></div>
        <div class="exp-net-stat"><div class="nv">{{ $net['epoch_progress'] ?? '' }}</div><div class="nl">{{ __('messages.explorer.validators.epoch_progress') }}</div></div>
        <div class="exp-net-stat"><div class="nv">{{ $net['epoch_ends'] ?? '' }}</div><div class="nl">{{ __('messages.explorer.validators.epoch_ends') }}</div></div>
        <div class="exp-net-stat"><div class="nv" style="color:#9FE870">{{ $net['avg_apy'] ?? '' }}</div><div class="nl">{{ __('messages.explorer.validators.avg_apy') }} <span style="color:rgba(255,255,255,0.3)">{{ $net['apy_change'] ?? '' }}</span></div></div>
      </div>

      <div class="exp-card">
        <div class="exp-card-title">{{ __('messages.explorer.validators.set') }}</div>
        <table class="exp-table">
          <thead><tr>
            <th>{{ __('messages.explorer.validators.th_validator') }}</th>
            <th>{{ __('messages.explorer.validators.th_stake') }}</th>
            <th>{{ __('messages.explorer.validators.th_voting') }}</th>
            <th>{{ __('messages.explorer.validators.th_apy') }}</th>
            <th>{{ __('messages.explorer.common.status') }}</th>
          </tr></thead>
          <tbody>
            @foreach($c['validators'] ?? [] as $v)
            <tr>
              <td class="bright">{{ $v['name'] }}</td>
              <td class="mono">{{ $v['stake'] }}</td>
              <td>
                <div style="display:flex;align-items:center;gap:.5rem">
                  <div style="flex:1;height:4px;background:rgba(255,255,255,0.1);border-radius:9999px;overflow:hidden;width:60px">
                    <div style="height:100%;background:#9FE870;border-radius:9999px;width:{{ (float)$v['voting'] }}%"></div>
                  </div>
                  <span>{{ $v['voting'] }}</span>
                </div>
              </td>
              <td style="color:#9FE870;font-weight:600">{{ $v['apy'] }}</td>
              <td><span class="exp-badge exp-badge-{{ $v['status'] }}">{{ str_replace('_', ' ', $v['status']) }}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="exp-card" style="display:flex;gap:2rem;flex-wrap:wrap">
        <div><div style="font-size:.85rem;font-weight:600;color:#fff">{{ $net['consensus'] ?? '' }}</div><div style="font-size:.68rem;text-transform:uppercase;letter-spacing:.07em;color:rgba(255,255,255,0.3)">{{ __('messages.explorer.validators.consensus') }}</div></div>
        <div><div style="font-size:.85rem;font-weight:600;color:#fff">{{ $net['candidate_validators'] ?? '' }}</div><div style="font-size:.68rem;text-transform:uppercase;letter-spacing:.07em;color:rgba(255,255,255,0.3)">{{ __('messages.explorer.validators.candidates') }}</div></div>
      </div>
    @break

    @default
      <div class="exp-card" style="text-align:center;padding:3rem">
        <div style="color:rgba(255,255,255,0.3);font-size:.9rem">{{ __('messages.explorer.no_content') }}</div>
      </div>
    @endswitch

  </main>
</div>
@endsection
