@extends('layouts.admin')
@section('title', isset($link) ? 'Edit Link' : 'New Link')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.footer-links.index') }}">Footer Links</a></li>
  <li class="breadcrumb-item active">{{ isset($link) ? 'Edit' : 'New' }}</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">{{ isset($link) ? 'Edit Link' : 'New Link' }}</h1></div>

<div class="row"><div class="col-lg-5">
<form method="POST" action="{{ isset($link) ? route('admin.footer-links.update', $link) : route('admin.footer-links.store') }}">
  @csrf @if(isset($link)) @method('PUT') @endif
  <div class="admin-card p-4">
    <div class="mb-3">
      <label class="form-label">Group</label>
      <input type="text" name="group_name" class="form-control" required placeholder="Developers"
             value="{{ old('group_name', $link->group_name ?? '') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Label</label>
      <input type="text" name="label" class="form-control" required value="{{ old('label', $link->label ?? '') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">URL</label>
      <input type="text" name="url" class="form-control" required value="{{ old('url', $link->url ?? '#') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Sort Order</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $link->sort_order ?? 0) }}">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
             {{ (old('is_active', $link->is_active ?? true)) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_active">Active</label>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-accent flex-fill">Save</button>
      <a href="{{ route('admin.footer-links.index') }}" class="btn btn-wise-secondary flex-fill">Cancel</a>
    </div>
  </div>
</form>
</div></div>
@endsection
