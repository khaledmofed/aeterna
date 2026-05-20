@extends('layouts.admin')
@section('title', isset($item) ? 'Edit Nav Item' : 'New Nav Item')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.navigation.index') }}">Navigation</a></li>
  <li class="breadcrumb-item active">{{ isset($item) ? 'Edit' : 'New' }}</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">{{ isset($item) ? 'Edit Nav Item' : 'New Nav Item' }}</h1></div>

<div class="row"><div class="col-lg-6">
<form method="POST" action="{{ isset($item) ? route('admin.navigation.update', $item) : route('admin.navigation.store') }}">
  @csrf
  @if(isset($item)) @method('PUT') @endif
  <div class="admin-card p-4">
    <div class="mb-3">
      <label class="form-label">Label</label>
      <input type="text" name="label" class="form-control" required value="{{ old('label', $item->label ?? '') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">URL</label>
      <input type="text" name="url" class="form-control" required value="{{ old('url', $item->url ?? '#') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Target</label>
      <select name="target" class="form-select">
        <option value="_self" {{ (old('target', $item->target ?? '_self')) === '_self' ? 'selected' : '' }}>Same Tab (_self)</option>
        <option value="_blank" {{ (old('target', $item->target ?? '_self')) === '_blank' ? 'selected' : '' }}>New Tab (_blank)</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Parent <small style="color:var(--wise-mute)">(optional)</small></label>
      <select name="parent_id" class="form-select">
        <option value="">; Top Level ;</option>
        @foreach($parents as $p)
          <option value="{{ $p->id }}" {{ (old('parent_id', $item->parent_id ?? '')) == $p->id ? 'selected' : '' }}>{{ $p->label }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Sort Order</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
             {{ (old('is_active', $item->is_active ?? true)) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_active">Active</label>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-accent flex-fill">Save</button>
      <a href="{{ route('admin.navigation.index') }}" class="btn btn-wise-secondary flex-fill">Cancel</a>
    </div>
  </div>
</form>
</div></div>
@endsection
