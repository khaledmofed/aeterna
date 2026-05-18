@extends('layouts.admin')
@section('title','Hero Section')
@section('breadcrumb')
  <li class="breadcrumb-item active">Hero Section</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Hero Section</h1>
</div>

<form method="POST" action="{{ route('admin.hero.update') }}">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold text-white mb-4">Content</h6>
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
          <h6 class="fw-semibold text-white mb-0">Stats</h6>
          <button type="button" id="add-stat" class="btn btn-sm btn-outline-secondary" style="font-size:.78rem">+ Add Stat</button>
        </div>
        <div id="stats-container">
          @foreach(old('stats', $hero->stats_json ?? []) as $i => $stat)
          <div class="row g-2 mb-2 stat-row">
            <div class="col-5"><input type="text" name="stats[{{ $i }}][value]" class="form-control form-control-sm" placeholder="160K+" value="{{ $stat['value'] ?? '' }}"></div>
            <div class="col-5"><input type="text" name="stats[{{ $i }}][label]" class="form-control form-control-sm" placeholder="TPS" value="{{ $stat['label'] ?? '' }}"></div>
            <div class="col-2"><button type="button" class="btn btn-sm btn-outline-danger w-100 remove-row">✕</button></div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="admin-card p-4">
        <h6 class="fw-semibold text-white mb-4">Settings</h6>
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $hero->is_active ? 'checked' : '' }}>
          <label class="form-check-label text-white-50" for="is_active">Section Active</label>
        </div>
        <button type="submit" class="btn btn-accent w-100">Save Changes</button>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
let statIdx = {{ count($hero->stats_json ?? []) }};
document.getElementById('add-stat').addEventListener('click', () => {
  const c = document.getElementById('stats-container');
  c.insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 stat-row">
    <div class="col-5"><input type="text" name="stats[${statIdx}][value]" class="form-control form-control-sm" placeholder="160K+"></div>
    <div class="col-5"><input type="text" name="stats[${statIdx}][label]" class="form-control form-control-sm" placeholder="TPS"></div>
    <div class="col-2"><button type="button" class="btn btn-sm btn-outline-danger w-100 remove-row">✕</button></div>
  </div>`);
  statIdx++;
});
document.addEventListener('click', e => { if (e.target.classList.contains('remove-row')) e.target.closest('.stat-row').remove(); });
</script>
@endsection
