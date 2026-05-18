@extends('layouts.admin')
@section('title','Roadmap')
@section('breadcrumb')<li class="breadcrumb-item active">Roadmap</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Roadmap</h1>
  <a href="{{ route('admin.roadmap.create') }}" class="btn btn-accent btn-sm px-3">+ Add Stage</a>
</div>
<div class="row g-4">
  @forelse($stages as $stage)
  <div class="col-md-6">
    <div class="admin-card p-4">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
          <span class="badge me-2" style="background:rgba(235,255,0,.1);color:#EBFF00;font-size:.72rem">Stage {{ $stage->stage_number }}</span>
          <span class="text-white fw-semibold">{{ $stage->name }}</span>
        </div>
        <span class="badge" style="{{ $stage->status === 'active' ? 'background:rgba(235,255,0,.15);color:#EBFF00' : ($stage->status === 'completed' ? 'background:rgba(74,222,128,.15);color:#4ade80' : 'background:rgba(255,255,255,.06);color:rgba(255,255,255,.4)') }};font-size:.72rem">{{ ucfirst($stage->status) }}</span>
      </div>
      <div class="text-white-50 mb-3" style="font-size:.82rem">{{ $stage->timeframe }}</div>
      <div class="text-white-50 mb-3" style="font-size:.78rem">{{ count($stage->milestones_json ?? []) }} milestones</div>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.roadmap.edit', $stage) }}" class="btn btn-sm btn-outline-secondary" style="font-size:.75rem">Edit</a>
        <form method="POST" action="{{ route('admin.roadmap.destroy', $stage) }}" onsubmit="return confirm('Delete?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger" style="font-size:.75rem">Delete</button>
        </form>
      </div>
    </div>
  </div>
  @empty
  <div class="col"><p class="text-white-50">No stages yet.</p></div>
  @endforelse
</div>
@endsection
