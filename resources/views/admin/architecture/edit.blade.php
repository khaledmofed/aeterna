@extends('layouts.admin')
@section('title','Edit Layer')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.architecture.index') }}">Architecture</a></li>
  <li class="breadcrumb-item active">Edit L{{ $layer->layer_number }}</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="h4 fw-bold text-white mb-0">Edit — {{ $layer->name }}</h1></div>

<form method="POST" action="{{ route('admin.architecture.update', $layer) }}">
  @csrf @method('PUT')
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold text-white mb-4">Layer Info</h6>
        <div class="mb-3">
          <label class="form-label">Layer Name</label>
          <input type="text" name="name" class="form-control" required value="{{ old('name', $layer->name) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description', $layer->description) }}</textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Icon SVG</label>
          <textarea name="icon_svg" class="form-control" rows="3" style="font-family:monospace;font-size:.8rem">{{ old('icon_svg', $layer->icon_svg) }}</textarea>
        </div>
      </div>

      <div class="admin-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="fw-semibold text-white mb-0">Features</h6>
          <button type="button" id="add-feature" class="btn btn-sm btn-outline-secondary" style="font-size:.78rem">+ Add Feature</button>
        </div>
        <div id="features-container">
          @foreach(old('features', $layer->features_json ?? []) as $i => $feat)
          <div class="feature-row border border-secondary rounded p-3 mb-3" style="border-color:rgba(255,255,255,.1)!important">
            <div class="mb-2 row g-2">
              <div class="col-md-4">
                <input type="text" name="features[{{ $i }}][title]" class="form-control form-control-sm" placeholder="Title" value="{{ $feat['title'] ?? '' }}">
              </div>
              <div class="col-md-2">
                <input type="text" name="features[{{ $i }}][icon_svg]" class="form-control form-control-sm" placeholder="Icon (emoji)" value="{{ $feat['icon_svg'] ?? '' }}">
              </div>
              <div class="col-md-5">
                <input type="text" name="features[{{ $i }}][description]" class="form-control form-control-sm" placeholder="Description" value="{{ $feat['description'] ?? '' }}">
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-outline-danger w-100 remove-feat">✕</button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="admin-card p-4">
        <h6 class="fw-semibold text-white mb-4">Settings</h6>
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ $layer->is_active ? 'checked' : '' }}>
          <label class="form-check-label text-white-50" for="is_active">Active</label>
        </div>
        <button type="submit" class="btn btn-accent w-100">Save Changes</button>
        <a href="{{ route('admin.architecture.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
let fi = {{ count($layer->features_json ?? []) }};
document.getElementById('add-feature').addEventListener('click', () => {
  document.getElementById('features-container').insertAdjacentHTML('beforeend', `
  <div class="feature-row border border-secondary rounded p-3 mb-3" style="border-color:rgba(255,255,255,.1)!important">
    <div class="row g-2">
      <div class="col-md-4"><input type="text" name="features[${fi}][title]" class="form-control form-control-sm" placeholder="Title"></div>
      <div class="col-md-2"><input type="text" name="features[${fi}][icon_svg]" class="form-control form-control-sm" placeholder="Icon"></div>
      <div class="col-md-5"><input type="text" name="features[${fi}][description]" class="form-control form-control-sm" placeholder="Description"></div>
      <div class="col-md-1"><button type="button" class="btn btn-sm btn-outline-danger w-100 remove-feat">✕</button></div>
    </div>
  </div>`);
  fi++;
});
document.addEventListener('click', e => { if (e.target.classList.contains('remove-feat')) e.target.closest('.feature-row').remove(); });
</script>
@endsection
