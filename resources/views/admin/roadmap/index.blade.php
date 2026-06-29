@extends('layouts.admin')
@section('title','Roadmap')
@section('breadcrumb')<li class="breadcrumb-item active">Roadmap</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Roadmap</h1>
  <a href="{{ route('admin.roadmap.create') }}" class="btn btn-accent btn-sm px-4">+ Add Stage</a>
</div>
<div class="row g-4">
  @forelse($stages as $stage)
  <div class="col-md-6">
    <div class="admin-card p-4">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-center gap-2">
          <span class="wise-badge wise-badge-stage">Stage {{ $stage->stage_number }}</span>
          <span style="font-size:.9rem;font-weight:600;color:var(--wise-ink)">{{ $stage->name }}</span>
        </div>
        @php
          $statusClass = match($stage->status) {
            'active'    => 'wise-badge-active',
            'completed' => 'wise-badge-primary',
            default     => 'wise-badge-inactive',
          };
        @endphp
        <span class="wise-badge {{ $statusClass }}">{{ ucfirst($stage->status) }}</span>
      </div>
      <div style="font-size:.82rem;color:var(--wise-mute)" class="mb-2">{{ $stage->timeframe }}</div>
      <div style="font-size:.78rem;color:var(--wise-mute)" class="mb-3">{{ count(json_decode($stage->milestones_json ?? '[]', true) ?? []) }} milestones</div>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.roadmap.edit', $stage) }}" class="btn btn-wise-outline btn-sm">Edit</a>
        <form method="POST" action="{{ route('admin.roadmap.destroy', $stage) }}" onsubmit="return confirm('Delete?')">
          @csrf @method('DELETE')
          <button class="btn btn-wise-danger btn-sm">Delete</button>
        </form>
      </div>
    </div>
  </div>
  @empty
  <div class="col"><p style="color:var(--wise-mute)">No stages yet.</p></div>
  @endforelse
</div>
@endsection
