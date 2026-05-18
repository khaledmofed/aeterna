@extends('layouts.admin')
@section('title','Architecture')
@section('breadcrumb')<li class="breadcrumb-item active">Architecture</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Architecture Layers</h1>
</div>

<div class="row g-4">
  @foreach($layers as $layer)
  <div class="col-md-6">
    <div class="admin-card p-4">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
          <span class="badge badge-accent me-2" style="font-size:.72rem">L{{ $layer->layer_number }}</span>
          <span class="text-white fw-semibold">{{ $layer->name }}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="badge" style="{{ $layer->is_active ? 'background:rgba(74,222,128,.15);color:#4ade80' : 'background:rgba(255,255,255,.06);color:rgba(255,255,255,.4)' }};font-size:.72rem">{{ $layer->is_active ? 'Active' : 'Inactive' }}</span>
          <a href="{{ route('admin.architecture.edit', $layer) }}" class="btn btn-sm btn-outline-secondary" style="font-size:.75rem">Edit</a>
        </div>
      </div>
      <p class="text-white-50 mb-3" style="font-size:.83rem;line-height:1.5">{{ Str::limit($layer->description, 100) }}</p>
      <div class="text-white-50" style="font-size:.78rem">{{ count($layer->features_json ?? []) }} features</div>
    </div>
  </div>
  @endforeach
</div>
@endsection
