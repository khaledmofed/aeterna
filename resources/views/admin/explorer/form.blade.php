@extends('layouts.admin')
@section('title', 'Edit Explorer Page')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.explorer.index') }}">Explorer Pages</a></li>
  <li class="breadcrumb-item active">Edit &ldquo;{{ $page->title }}&rdquo;</li>
@endsection

@section('content')
<div class="mb-4">
  <h1 class="admin-section-title">Edit Explorer Page</h1>
</div>

@if($errors->any())
  <div class="wise-alert wise-alert-error mb-4">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <ul class="mb-0 ps-3">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('admin.explorer.update', $page) }}">
  @csrf
  @method('PUT')

  <div class="row g-4">
    {{-- Main fields --}}
    <div class="col-lg-8">
      <div class="admin-card p-4 mb-4">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" required
                 value="{{ old('title', $page->title) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description', $page->description) }}</textarea>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Tag</label>
            <input type="text" name="tag" class="form-control"
                   value="{{ old('tag', $page->tag) }}" placeholder="e.g. Core + AI">
          </div>
          <div class="col-md-6">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $page->sort_order) }}">
          </div>
        </div>
      </div>

      <div class="admin-card p-4 mb-4">
        <div class="mb-3">
          <label class="form-label">Icon SVG</label>
          <small class="text-muted d-block mb-1" style="font-size:.78rem">Inner path content only (no &lt;svg&gt; wrapper). Rendered at 18×18, stroke-based.</small>
          <textarea name="icon_svg" class="form-control" rows="4"
                    style="font-family:monospace;font-size:.78rem">{{ old('icon_svg', $page->icon_svg) }}</textarea>
        </div>
      </div>

      <div class="admin-card p-4">
        <label class="form-label">Content JSON</label>
        <small class="text-muted d-block mb-2" style="font-size:.78rem">
          Edit the page data as JSON. This drives all rendered content on the explorer page.
          Must be valid JSON — the form will validate before saving.
        </small>
        @error('content_json')
          <div class="mb-2" style="color:var(--wise-negative);font-size:.82rem"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
        @enderror
        <textarea name="content_json" id="content_json" class="form-control" rows="22"
                  style="font-family:'Fira Code',monospace;font-size:.78rem;line-height:1.6">{{ old('content_json', is_array($page->content_json) ? json_encode($page->content_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : $page->content_json) }}</textarea>
      </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
      <div class="admin-card p-4 mb-4">
        <div style="font-size:.8rem;font-weight:600;color:var(--wise-mute);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.75rem">Page Info</div>
        <div class="mb-3">
          <div style="font-size:.75rem;color:var(--wise-mute)">Slug</div>
          <div style="font-family:monospace;font-size:.85rem;color:var(--wise-ink);font-weight:600">{{ $page->slug }}</div>
        </div>
        <div class="mb-3">
          <div style="font-size:.75rem;color:var(--wise-mute)">Public URL</div>
          <a href="{{ route('explorer.show', $page->slug) }}" target="_blank"
             style="font-size:.8rem;color:var(--wise-positive);word-break:break-all">
            /explorer/{{ $page->slug }} <i class="bi bi-box-arrow-up-right"></i>
          </a>
        </div>
      </div>

      <div class="admin-card p-4">
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                 {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Active (visible on site)</label>
        </div>

        <button type="submit" class="btn btn-accent w-100">Save Changes</button>
        <a href="{{ route('admin.explorer.index') }}" class="btn btn-wise-secondary w-100 mt-2">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
// Client-side JSON validation on submit
document.querySelector('form').addEventListener('submit', function(e) {
  const ta = document.getElementById('content_json');
  const val = ta.value.trim();
  if (!val) return;
  try {
    JSON.parse(val);
  } catch (err) {
    e.preventDefault();
    ta.style.borderColor = 'var(--wise-negative)';
    ta.scrollIntoView({ behavior: 'smooth', block: 'center' });
    alert('Invalid JSON: ' + err.message);
  }
});
document.getElementById('content_json').addEventListener('input', function() {
  this.style.borderColor = '';
});
</script>
@endsection
