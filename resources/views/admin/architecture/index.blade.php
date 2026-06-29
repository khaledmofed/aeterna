@extends('layouts.admin')
@section('title','Architecture')
@section('breadcrumb')<li class="breadcrumb-item active">Architecture</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Architecture Layers</h1>
</div>

<div class="row g-4">
  @foreach($layers as $layer)
  <div class="col-md-6">
    <div class="admin-card p-4">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-center gap-2">
          <span class="wise-badge wise-badge-stage">L{{ $layer->layer_number }}</span>
          <span style="font-size:.9rem;font-weight:600;color:var(--wise-ink)">{{ $layer->name }}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="wise-badge {{ $layer->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}">
            {{ $layer->is_active ? 'Active' : 'Inactive' }}
          </span>
          <a href="{{ route('admin.architecture.edit', $layer) }}" class="btn btn-wise-outline btn-sm">Edit</a>
        </div>
      </div>
      <p style="font-size:.83rem;line-height:1.5;color:var(--wise-body)" class="mb-2">{{ Str::limit($layer->description, 100) }}</p>
      <div style="font-size:.78rem;color:var(--wise-mute)">{{ count(json_decode($layer->features_json ?? '[]', true) ?? []) }} features</div>
    </div>
  </div>
  @endforeach
</div>
@endsection
