@extends('layouts.admin')
@section('title', isset($investor) ? 'Edit Investor' : 'New Investor')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.investors.index') }}">Investors</a></li>
  <li class="breadcrumb-item active">{{ isset($investor) ? 'Edit' : 'New' }}</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="h4 fw-bold text-white mb-0">{{ isset($investor) ? 'Edit Investor' : 'New Investor' }}</h1></div>

<div class="row"><div class="col-lg-6">
<form method="POST" action="{{ isset($investor) ? route('admin.investors.update', $investor) : route('admin.investors.store') }}">
  @csrf @if(isset($investor)) @method('PUT') @endif
  <div class="admin-card p-4">
    <div class="mb-3"><label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required value="{{ old('name', $investor->name ?? '') }}">
    </div>
    <div class="mb-3"><label class="form-label">Logo URL</label>
      <input type="text" name="logo_url" class="form-control" placeholder="https://..." value="{{ old('logo_url', $investor->logo_url ?? '') }}">
    </div>
    <div class="mb-3"><label class="form-label">Website URL</label>
      <input type="text" name="website_url" class="form-control" placeholder="https://..." value="{{ old('website_url', $investor->website_url ?? '') }}">
    </div>
    <div class="mb-3"><label class="form-label">Glow Color</label>
      <div class="d-flex gap-2 align-items-center">
        <input type="color" name="glow_color" class="form-control form-control-color" value="{{ old('glow_color', $investor->glow_color ?? '#ffffff') }}">
        <input type="text" name="glow_color_text" class="form-control form-control-sm" placeholder="#EBFF00" value="{{ old('glow_color', $investor->glow_color ?? '') }}">
      </div>
    </div>
    <div class="mb-3"><label class="form-label">Type</label>
      <select name="type" class="form-select">
        @foreach(['lead','strategic','partner'] as $t)
          <option value="{{ $t }}" {{ (old('type', $investor->type ?? 'strategic')) === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3"><label class="form-label">Sort Order</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $investor->sort_order ?? 0) }}">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ (old('is_active', $investor->is_active ?? true)) ? 'checked' : '' }}>
      <label class="form-check-label text-white-50" for="is_active">Active</label>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-accent flex-fill">Save</button>
      <a href="{{ route('admin.investors.index') }}" class="btn btn-outline-secondary flex-fill">Cancel</a>
    </div>
  </div>
</form>
</div></div>
@endsection
