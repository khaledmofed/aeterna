@extends('layouts.admin')
@section('title', isset($stage) ? 'Edit Stage' : 'New Stage')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.roadmap.index') }}">Roadmap</a></li>
  <li class="breadcrumb-item active">{{ isset($stage) ? 'Edit' : 'New' }}</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">{{ isset($stage) ? 'Edit Stage' : 'New Stage' }}</h1></div>

<div class="row"><div class="col-lg-7">
<form method="POST" action="{{ isset($stage) ? route('admin.roadmap.update', $stage) : route('admin.roadmap.store') }}">
  @csrf @if(isset($stage)) @method('PUT') @endif
  <div class="admin-card p-4">
    <div class="row g-3 mb-3">
      <div class="col-4">
        <label class="form-label">Stage #</label>
        <input type="number" name="stage_number" class="form-control" required value="{{ old('stage_number', $stage->stage_number ?? '') }}">
      </div>
      <div class="col-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $stage->name ?? '') }}">
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Timeframe</label>
      <input type="text" name="timeframe" class="form-control" placeholder="Year 1 — Q1 & Q2" value="{{ old('timeframe', $stage->timeframe ?? '') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        @foreach(['completed','active','upcoming'] as $s)
          <option value="{{ $s }}" {{ (old('status', $stage->status ?? 'upcoming')) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Milestones <small style="color:var(--wise-mute)">(one per line)</small></label>
      <textarea name="milestones" class="form-control" rows="8">{{ old('milestones', implode("\n", $stage->milestones_json ?? [])) }}</textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Sort Order</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $stage->sort_order ?? 0) }}">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
             {{ (old('is_active', $stage->is_active ?? true)) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_active">Active</label>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-accent flex-fill">Save</button>
      <a href="{{ route('admin.roadmap.index') }}" class="btn btn-wise-secondary flex-fill">Cancel</a>
    </div>
  </div>
</form>
</div></div>
@endsection
