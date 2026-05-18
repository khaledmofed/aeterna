@extends('layouts.admin')
@section('title','Dashboard')
@section('breadcrumb')<li class="breadcrumb-item active">Dashboard</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Dashboard</h1>
</div>

<div class="row g-4 mb-5">
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ number_format($totalSubscribers) }}</div>
      <div class="stat-label">Email Subscribers</div>
      <i class="bi bi-envelope-at mt-2" style="font-size:1.5rem;color:rgba(235,255,0,.3)"></i>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ $activeSections }}</div>
      <div class="stat-label">Active Sections</div>
      <i class="bi bi-layers mt-2" style="font-size:1.5rem;color:rgba(235,255,0,.3)"></i>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ $investorsCount }}</div>
      <div class="stat-label">Investors</div>
      <i class="bi bi-building mt-2" style="font-size:1.5rem;color:rgba(235,255,0,.3)"></i>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-value">{{ $roadmapStages }}</div>
      <div class="stat-label">Roadmap Stages</div>
      <i class="bi bi-map mt-2" style="font-size:1.5rem;color:rgba(235,255,0,.3)"></i>
    </div>
  </div>
</div>

<!-- Quick links -->
<div class="row g-3 mb-5">
  @php $sections = [
    ['icon'=>'bi-stars','label'=>'Hero Section','route'=>'admin.hero'],
    ['icon'=>'bi-menu-button-wide','label'=>'Navigation','route'=>'admin.navigation.index'],
    ['icon'=>'bi-layers','label'=>'Architecture','route'=>'admin.architecture.index'],
    ['icon'=>'bi-coin','label'=>'Tokenomics','route'=>'admin.tokenomics'],
    ['icon'=>'bi-map','label'=>'Roadmap','route'=>'admin.roadmap.index'],
    ['icon'=>'bi-briefcase','label'=>'Use Cases','route'=>'admin.use-cases.index'],
    ['icon'=>'bi-building','label'=>'Investors','route'=>'admin.investors.index'],
    ['icon'=>'bi-link-45deg','label'=>'Footer Links','route'=>'admin.footer-links.index'],
  ]; @endphp
  @foreach($sections as $s)
  <div class="col-6 col-md-3">
    <a href="{{ route($s['route']) }}" class="admin-card d-flex align-items-center gap-3 p-3 text-decoration-none" style="color:rgba(255,255,255,.7);transition:.2s" onmouseover="this.style.borderColor='rgba(235,255,0,.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)'">
      <i class="bi {{ $s['icon'] }} fs-5" style="color:#EBFF00"></i>
      <span style="font-size:.85rem">{{ $s['label'] }}</span>
    </a>
  </div>
  @endforeach
</div>

<!-- Recent subscribers -->
<div class="admin-card p-0">
  <div class="p-4 border-bottom" style="border-color:rgba(255,255,255,.07)!important">
    <h5 class="fw-semibold text-white mb-0">Recent Subscribers</h5>
  </div>
  <div class="table-responsive">
    <table class="table table-dark table-hover mb-0">
      <thead><tr>
        <th class="fw-medium text-white-50" style="font-size:.8rem">#</th>
        <th class="fw-medium text-white-50" style="font-size:.8rem">Email</th>
        <th class="fw-medium text-white-50" style="font-size:.8rem">Subscribed</th>
        <th class="fw-medium text-white-50" style="font-size:.8rem">Status</th>
      </tr></thead>
      <tbody>
        @forelse($recentSubscribers as $sub)
        <tr>
          <td style="font-size:.82rem;color:rgba(255,255,255,.4)">{{ $sub->id }}</td>
          <td style="font-size:.82rem;color:#fff">{{ $sub->email }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45)">{{ $sub->subscribed_at->diffForHumans() }}</td>
          <td><span class="badge badge-accent" style="font-size:.72rem">Active</span></td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center py-4" style="color:rgba(255,255,255,.3);font-size:.85rem">No subscribers yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
