@extends('layouts.admin')
@section('title', isset($useCase) ? 'Edit Use Case' : 'New Use Case')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.use-cases.index') }}">Use Cases</a></li>
  <li class="breadcrumb-item active">{{ isset($useCase) ? 'Edit' : 'New' }}</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">{{ isset($useCase) ? 'Edit Use Case' : 'New Use Case' }}</h1></div>

<form method="POST" action="{{ isset($useCase) ? route('admin.use-cases.update', $useCase) : route('admin.use-cases.store') }}">
  @csrf @if(isset($useCase)) @method('PUT') @endif
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4 mb-4">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" required value="{{ old('title', $useCase->title ?? '') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="4">{{ old('description', $useCase->description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Icon SVG</label>
          <textarea name="icon_svg" class="form-control" rows="3" style="font-family:monospace;font-size:.8rem">{{ old('icon_svg', $useCase->icon_svg ?? '') }}</textarea>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $useCase->category ?? '') }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $useCase->sort_order ?? 0) }}">
          </div>
        </div>
      </div>

      <div class="admin-card p-4">
        <div class="d-flex justify-content-between mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Features</h6>
          <button type="button" id="add-feat" class="btn btn-wise-secondary btn-sm">+ Add</button>
        </div>
        <div id="feat-container">
          @foreach(old('features', $useCase->features_json ?? []) as $i => $f)
          <div class="row g-2 mb-2 feat-row">
            <div class="col-4"><input type="text" name="features[{{ $i }}][title]" class="form-control form-control-sm" placeholder="Title" value="{{ $f['title'] ?? '' }}"></div>
            <div class="col-7"><input type="text" name="features[{{ $i }}][description]" class="form-control form-control-sm" placeholder="Description" value="{{ $f['description'] ?? '' }}"></div>
            <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-row">✕</button></div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="admin-card p-4">
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                 {{ (old('is_active', $useCase->is_active ?? true)) ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Active</label>
        </div>
        <button type="submit" class="btn btn-accent w-100">Save</button>
        <a href="{{ route('admin.use-cases.index') }}" class="btn btn-wise-secondary w-100 mt-2">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
let fi = {{ count($useCase->features_json ?? []) }};
document.getElementById('add-feat').addEventListener('click', () => {
  document.getElementById('feat-container').insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 feat-row">
    <div class="col-4"><input type="text" name="features[${fi}][title]" class="form-control form-control-sm" placeholder="Title"></div>
    <div class="col-7"><input type="text" name="features[${fi}][description]" class="form-control form-control-sm" placeholder="Description"></div>
    <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-row">✕</button></div>
  </div>`);
  fi++;
});
document.addEventListener('click', e => { if (e.target.classList.contains('remove-row')) e.target.closest('.feat-row').remove(); });
</script>
@endsection
