@extends('layouts.admin')
@section('title','Hero Section')
@section('breadcrumb')
  <li class="breadcrumb-item active">Hero Section</li>
@endsection

@section('content')
@php
$langs = [
    'en'    => ['flag' => '🇺🇸', 'name' => 'English'],
    'ja'    => ['flag' => '🇯🇵', 'name' => 'Japanese'],
    'ko'    => ['flag' => '🇰🇷', 'name' => 'Korean'],
    'es'    => ['flag' => '🇪🇸', 'name' => 'Spanish'],
    'zh-TW' => ['flag' => '🇹🇼', 'name' => '中文(繁)'],
    'vi'    => ['flag' => '🇻🇳', 'name' => 'Vietnamese'],
];
$tabPrefix = 'hero';
@endphp
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Hero Section</h1>
</div>

<form method="POST" action="{{ route('admin.hero.update') }}">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <!-- Translatable content with language tabs -->
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-3" style="color:var(--wise-ink)">Content</h6>
        @include('admin.partials.lang-tabs')
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}"
               id="{{ $tabPrefix }}-{{ str_replace('-','_',$locale) }}" role="tabpanel">
            <div class="mb-3">
              <label class="form-label">Badge Text <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <input type="text" name="badge_text[{{ $locale }}]" class="form-control"
                     value="{{ old('badge_text.'.$locale, $hero->getTranslation('badge_text', $locale, false)) }}">
            </div>
            <div class="mb-3">
              <label class="form-label">Headline <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <input type="text" name="headline[{{ $locale }}]" class="form-control"
                     value="{{ old('headline.'.$locale, $hero->getTranslation('headline', $locale, false)) }}">
            </div>
            <div class="mb-3">
              <label class="form-label">Subheadline <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <textarea name="subheadline[{{ $locale }}]" class="form-control" rows="3">{{ old('subheadline.'.$locale, $hero->getTranslation('subheadline', $locale, false)) }}</textarea>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Primary CTA Text <span class="text-muted small">({{ $lang['flag'] }})</span></label>
                <input type="text" name="cta_primary_text[{{ $locale }}]" class="form-control"
                       value="{{ old('cta_primary_text.'.$locale, $hero->getTranslation('cta_primary_text', $locale, false)) }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Secondary CTA Text <span class="text-muted small">({{ $lang['flag'] }})</span></label>
                <input type="text" name="cta_secondary_text[{{ $locale }}]" class="form-control"
                       value="{{ old('cta_secondary_text.'.$locale, $hero->getTranslation('cta_secondary_text', $locale, false)) }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Email Placeholder <span class="text-muted small">({{ $lang['flag'] }})</span></label>
                <input type="text" name="email_placeholder[{{ $locale }}]" class="form-control"
                       value="{{ old('email_placeholder.'.$locale, $hero->getTranslation('email_placeholder', $locale, false)) }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Email CTA Button <span class="text-muted small">({{ $lang['flag'] }})</span></label>
                <input type="text" name="email_cta[{{ $locale }}]" class="form-control"
                       value="{{ old('email_cta.'.$locale, $hero->getTranslation('email_cta', $locale, false)) }}">
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Non-translatable: URLs -->
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-3" style="color:var(--wise-ink)">CTA URLs</h6>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Primary CTA URL</label>
            <input type="text" name="cta_primary_url" class="form-control" value="{{ old('cta_primary_url', $hero->cta_primary_url) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Secondary CTA URL</label>
            <input type="text" name="cta_secondary_url" class="form-control" value="{{ old('cta_secondary_url', $hero->cta_secondary_url) }}">
          </div>
        </div>
      </div>

      <!-- Stats repeater (per-language) -->
      @php $heroEnStats = json_decode($hero->getTranslation('stats_json','en',false) ?? '[]', true) ?? []; @endphp
      <div class="admin-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Stats</h6>
          <button type="button" id="add-stat" class="btn btn-wise-secondary btn-sm">+ Add (EN)</button>
        </div>
        <ul class="nav nav-pills mb-3 flex-wrap gap-1">
          @foreach($langs as $locale => $lang)
          <li class="nav-item">
            <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                    data-bs-toggle="pill" data-bs-target="#hstat-{{ str_replace('-','_',$locale) }}" type="button">
              {{ $lang['flag'] }} {{ $lang['name'] }}
            </button>
          </li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          @php $locStats = json_decode($hero->getTranslation('stats_json',$locale,false) ?? '[]', true) ?? $heroEnStats; @endphp
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}" id="hstat-{{ str_replace('-','_',$locale) }}">
            <div class="hero-stat-container" data-locale="{{ $locale }}">
              @foreach($locStats as $i => $stat)
              @if(!empty($stat['value']))
              <div class="row g-2 mb-2 stat-row align-items-center" data-stat-index="{{ $i }}">
                @if($locale === 'en')
                <div class="col-auto drag-handle" style="cursor:grab;color:#aaa;font-size:18px;line-height:1">≡</div>
                <div class="col"><input type="text" name="stats[en][{{ $i }}][value]" class="form-control form-control-sm stat-value" placeholder="160K+" value="{{ $stat['value'] ?? '' }}"></div>
                @else
                <div class="col"><span class="form-control form-control-sm bg-light text-muted" style="line-height:1.5">{{ $heroEnStats[$i]['value'] ?? '' }}</span></div>
                @endif
                <div class="col"><input type="text" name="stats[{{ $locale }}][{{ $i }}][label]" class="form-control form-control-sm stat-label" placeholder="Label" value="{{ $stat['label'] ?? '' }}"></div>
                @if($locale === 'en')
                <div class="col-auto"><button type="button" class="btn btn-wise-danger btn-sm remove-hero-stat">✕</button></div>
                @endif
              </div>
              @endif
              @endforeach
            </div>
          </div>
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
<script>
const heroLocales = ['en','ja','ko','es','zh-TW','vi'];
let hsi = {{ count($heroEnStats) }};

document.getElementById('add-stat').addEventListener('click', () => {
  heroLocales.forEach(locale => {
    const c = document.querySelector(`.hero-stat-container[data-locale="${locale}"]`);
    if (!c) return;
    const isEn = locale === 'en';
    const valCol = isEn
      ? `<div class="col-auto drag-handle" style="cursor:grab;color:#aaa;font-size:18px;line-height:1">≡</div>
         <div class="col"><input type="text" name="stats[en][${hsi}][value]" class="form-control form-control-sm stat-value" placeholder="160K+"></div>`
      : `<div class="col"><span class="form-control form-control-sm bg-light text-muted" style="line-height:1.5">—</span></div>`;
    const removeBtn = isEn ? `<div class="col-auto"><button type="button" class="btn btn-wise-danger btn-sm remove-hero-stat">✕</button></div>` : '';
    c.insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 stat-row align-items-center" data-stat-index="${hsi}">
      ${valCol}
      <div class="col"><input type="text" name="stats[${locale}][${hsi}][label]" class="form-control form-control-sm stat-label" placeholder="Label"></div>
      ${removeBtn}
    </div>`);
  });
  hsi++;
});

document.addEventListener('click', e => {
  if (!e.target.classList.contains('remove-hero-stat')) return;
  const row = e.target.closest('.stat-row');
  const idx = row?.dataset.statIndex;
  document.querySelectorAll(`.stat-row[data-stat-index="${idx}"]`).forEach(r => r.remove());
});
</script>
@endsection
