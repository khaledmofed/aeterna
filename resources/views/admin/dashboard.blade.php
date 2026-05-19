@extends('layouts.admin')
@section('title','Dashboard')
@section('breadcrumb')<li class="breadcrumb-item active">Dashboard</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Dashboard</h1>
</div>

<!-- Stat Cards -->
<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ number_format($totalSubscribers) }}</div>
      <div class="stat-label">Email Subscribers</div>
      <i class="bi bi-envelope-at stat-icon"></i>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ $activeSections }}</div>
      <div class="stat-label">Active Sections</div>
      <i class="bi bi-layers stat-icon"></i>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ $investorsCount }}</div>
      <div class="stat-label">Investors</div>
      <i class="bi bi-building stat-icon"></i>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ $roadmapStages }}</div>
      <div class="stat-label">Roadmap Stages</div>
      <i class="bi bi-map stat-icon"></i>
    </div>
  </div>
</div>

<!-- Quick Links -->
<div class="row g-3 mb-4">
  @php $sections = [
    ['icon'=>'bi-stars',            'label'=>'Hero Section',  'route'=>'admin.hero'],
    ['icon'=>'bi-menu-button-wide', 'label'=>'Navigation',    'route'=>'admin.navigation.index'],
    ['icon'=>'bi-layers',           'label'=>'Architecture',  'route'=>'admin.architecture.index'],
    ['icon'=>'bi-coin',             'label'=>'Tokenomics',    'route'=>'admin.tokenomics'],
    ['icon'=>'bi-map',              'label'=>'Roadmap',       'route'=>'admin.roadmap.index'],
    ['icon'=>'bi-briefcase',        'label'=>'Use Cases',     'route'=>'admin.use-cases.index'],
    ['icon'=>'bi-building',         'label'=>'Investors',     'route'=>'admin.investors.index'],
    ['icon'=>'bi-link-45deg',       'label'=>'Footer Links',  'route'=>'admin.footer-links.index'],
  ]; @endphp
  @foreach($sections as $s)
  <div class="col-6 col-md-3">
    <a href="{{ route($s['route']) }}" class="quick-link-card">
      <i class="bi {{ $s['icon'] }}"></i>
      <span>{{ $s['label'] }}</span>
    </a>
  </div>
  @endforeach
</div>

<!-- Recent Subscribers -->
<div class="admin-card p-0">
  <div class="wise-card-header">Recent Subscribers</div>
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead><tr>
        <th>#</th>
        <th>Email</th>
        <th>Subscribed</th>
        <th>Status</th>
      </tr></thead>
      <tbody>
        @forelse($recentSubscribers as $sub)
        <tr>
          <td class="text-muted-cell">{{ $sub->id }}</td>
          <td>{{ $sub->email }}</td>
          <td class="text-muted-cell">{{ $sub->subscribed_at->diffForHumans() }}</td>
          <td><span class="wise-badge wise-badge-active">Active</span></td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center py-4" style="color:var(--wise-mute)">No subscribers yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
