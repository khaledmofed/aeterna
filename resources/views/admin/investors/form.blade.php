@extends('layouts.admin')
@section('title', isset($investor) ? 'Edit Investor' : 'New Investor')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.investors.index') }}">Investors</a></li>
  <li class="breadcrumb-item active">{{ isset($investor) ? 'Edit' : 'New' }}</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">{{ isset($investor) ? 'Edit Investor' : 'New Investor' }}</h1></div>

<div class="row"><div class="col-lg-6">
<form method="POST" action="{{ isset($investor) ? route('admin.investors.update', $investor) : route('admin.investors.store') }}" enctype="multipart/form-data">
  @csrf @if(isset($investor)) @method('PUT') @endif
  <div class="admin-card p-4">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required value="{{ old('name', $investor->name ?? '') }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Logo</label>
      {{-- Show current logo preview --}}
      @if(!empty($investor->logo_url ?? ''))
        <div class="mb-2 p-2 rounded" style="background:#1a1a1a;display:inline-block">
          <img src="{{ $investor->logo_url }}" alt="Current logo" style="height:40px;object-fit:contain;filter:brightness(0) invert(1)" onerror="this.style.display='none'">
        </div>
      @endif
      {{-- Upload file --}}
      <input type="file" name="logo_file" class="form-control mb-2" accept="image/*">
      <label class="form-label text-muted small">Or paste a URL:</label>
      <input type="text" name="logo_url" class="form-control" placeholder="https://..." value="{{ old('logo_url', $investor->logo_url ?? '') }}">
      <div class="form-text">Upload an image OR enter a URL. Upload takes priority.</div>
    </div>
    <div class="mb-3">
      <label class="form-label">Website URL</label>
      <input type="text" name="website_url" class="form-control" placeholder="https://..." value="{{ old('website_url', $investor->website_url ?? '') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Glow Color</label>
      <div class="d-flex gap-2 align-items-center">
        <input type="color" name="glow_color" class="form-control form-control-color" value="{{ old('glow_color', $investor->glow_color ?? '#9fe870') }}">
        <input type="text" name="glow_color_text" class="form-control form-control-sm" placeholder="#9fe870" value="{{ old('glow_color', $investor->glow_color ?? '') }}">
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Type</label>
      <select name="type" class="form-select">
        @foreach(['lead','strategic','partner'] as $t)
          <option value="{{ $t }}" {{ (old('type', $investor->type ?? 'strategic')) === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Sort Order</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $investor->sort_order ?? 0) }}">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
             {{ (old('is_active', $investor->is_active ?? true)) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_active">Active</label>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-accent flex-fill">Save</button>
      <a href="{{ route('admin.investors.index') }}" class="btn btn-wise-secondary flex-fill">Cancel</a>
    </div>
  </div>
</form>
</div></div>
@endsection
