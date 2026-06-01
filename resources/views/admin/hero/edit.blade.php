@extends('layouts.admin')
@section('title','Hero Section')
@section('breadcrumb')
  <li class="breadcrumb-item active">Hero Section</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Hero Section</h1>
</div>

<form method="POST" action="{{ route('admin.hero.update') }}">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">Content</h6>
        <div class="mb-3">
          <label class="form-label">Badge Text</label>
          <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $hero->badge_text) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Headline</label>
          <input type="text" name="headline" class="form-control" value="{{ old('headline', $hero->headline) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Subheadline</label>
          <textarea name="subheadline" class="form-control" rows="3">{{ old('subheadline', $hero->subheadline) }}</textarea>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Primary CTA Text</label>
            <input type="text" name="cta_primary_text" class="form-control" value="{{ old('cta_primary_text', $hero->cta_primary_text) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Primary CTA URL</label>
            <input type="text" name="cta_primary_url" class="form-control" value="{{ old('cta_primary_url', $hero->cta_primary_url) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Secondary CTA Text</label>
            <input type="text" name="cta_secondary_text" class="form-control" value="{{ old('cta_secondary_text', $hero->cta_secondary_text) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Secondary CTA URL</label>
            <input type="text" name="cta_secondary_url" class="form-control" value="{{ old('cta_secondary_url', $hero->cta_secondary_url) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Placeholder</label>
            <input type="text" name="email_placeholder" class="form-control" value="{{ old('email_placeholder', $hero->email_placeholder) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email CTA Button</label>
            <input type="text" name="email_cta" class="form-control" value="{{ old('email_cta', $hero->email_cta) }}">
          </div>
        </div>
      </div>

      <!-- Stats repeater -->
      <div class="admin-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Stats</h6>
          <button type="button" id="add-stat" class="btn btn-wise-secondary btn-sm">+ Add Stat</button>
        </div>
        <p class="text-muted small mb-3" style="font-size:12px">Drag ≡ to reorder</p>
        <div id="stats-container">
          @foreach(old('stats', $hero->stats_json ?? []) as $i => $stat)
          @if(!empty($stat['value']))
          <div class="row g-2 mb-2 stat-row align-items-center">
            <div class="col-auto drag-handle" style="cursor:grab;color:#aaa;font-size:18px;line-height:1">≡</div>
            <div class="col"><input type="text" name="stats[{{ $i }}][value]" class="form-control form-control-sm stat-value" placeholder="160K+" value="{{ $stat['value'] ?? '' }}"></div>
            <div class="col"><input type="text" name="stats[{{ $i }}][label]" class="form-control form-control-sm stat-label" placeholder="TPS" value="{{ $stat['label'] ?? '' }}"></div>
            <div class="col-auto"><button type="button" class="btn btn-wise-danger btn-sm remove-row">✕</button></div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="admin-card p-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">Settings</h6>
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $hero->is_active ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Section Active</label>
        </div>
        <button type="submit" class="btn btn-accent w-100">Save Changes</button>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
function reindex() {
  document.querySelectorAll('#stats-container .stat-row').forEach((row, i) => {
    const v = row.querySelector('.stat-value');
    const l = row.querySelector('.stat-label');
    if (v) v.name = `stats[${i}][value]`;
    if (l) l.name = `stats[${i}][label]`;
  });
}

// Drag & drop — reindex after each drop
Sortable.create(document.getElementById('stats-container'), {
  handle: '.drag-handle',
  animation: 150,
  ghostClass: 'bg-light',
  onEnd: reindex,
});

// Add new stat row
document.getElementById('add-stat').addEventListener('click', () => {
  const c = document.getElementById('stats-container');
  const i = c.querySelectorAll('.stat-row').length;
  c.insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 stat-row align-items-center">
    <div class="col-auto drag-handle" style="cursor:grab;color:#aaa;font-size:18px;line-height:1">≡</div>
    <div class="col"><input type="text" name="stats[${i}][value]" class="form-control form-control-sm stat-value" placeholder="160K+"></div>
    <div class="col"><input type="text" name="stats[${i}][label]" class="form-control form-control-sm stat-label" placeholder="TPS"></div>
    <div class="col-auto"><button type="button" class="btn btn-wise-danger btn-sm remove-row">✕</button></div>
  </div>`);
});

// Remove row — reindex after removal
document.addEventListener('click', e => {
  if (e.target.classList.contains('remove-row')) {
    e.target.closest('.stat-row').remove();
    reindex();
  }
});
</script>
@endsection
