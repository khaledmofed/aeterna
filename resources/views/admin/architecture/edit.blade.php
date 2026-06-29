@extends('layouts.admin')
@section('title','Edit Layer')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.architecture.index') }}">Architecture</a></li>
  <li class="breadcrumb-item active">Edit L{{ $layer->layer_number }}</li>
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
$tabPrefix = 'arch';
$enFeatures = json_decode($layer->getTranslation('features_json','en',false) ?? '[]', true) ?? [];
@endphp
<div class="mb-4"><h1 class="admin-section-title">Edit — {{ $layer->getTranslation('name','en',false) }}</h1></div>

<form method="POST" action="{{ route('admin.architecture.update', $layer) }}">
  @csrf @method('PUT')
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-3" style="color:var(--wise-ink)">Layer Info</h6>
        @include('admin.partials.lang-tabs')
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}"
               id="{{ $tabPrefix }}-{{ str_replace('-','_',$locale) }}" role="tabpanel">
            <div class="mb-3">
              <label class="form-label">Layer Name <span class="text-muted small">({{ $lang['flag'] }})</span>{{ $locale === 'en' ? ' *' : '' }}</label>
              <input type="text" name="name[{{ $locale }}]" class="form-control"
                     value="{{ old('name.'.$locale, $layer->getTranslation('name', $locale, false)) }}"
                     {{ $locale === 'en' ? 'required' : '' }}>
            </div>
            <div class="mb-3">
              <label class="form-label">Description <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <textarea name="description[{{ $locale }}]" class="form-control" rows="3">{{ old('description.'.$locale, $layer->getTranslation('description', $locale, false)) }}</textarea>
            </div>
          </div>
          @endforeach
        </div>
        <hr class="my-3">
        <div class="mb-3">
          <label class="form-label">Icon SVG</label>
          <textarea name="icon_svg" class="form-control" rows="3" style="font-family:monospace;font-size:.8rem">{{ old('icon_svg', $layer->icon_svg) }}</textarea>
        </div>
      </div>

      <!-- Features with language tabs -->
      <div class="admin-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Features</h6>
          <button type="button" id="add-feature" class="btn btn-wise-secondary btn-sm">+ Add Feature (EN)</button>
        </div>

        @php $featTabPrefix = 'feat'; @endphp
        <ul class="nav nav-pills mb-3 flex-wrap gap-1" id="feat-lang-tabs" role="tablist">
          @foreach($langs as $locale => $lang)
          <li class="nav-item" role="presentation">
            <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                    data-bs-toggle="pill"
                    data-bs-target="#feat-{{ str_replace('-','_',$locale) }}"
                    type="button" role="tab">
              {{ $lang['flag'] }} {{ $lang['name'] }}
            </button>
          </li>
          @endforeach
        </ul>

        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          @php
            $locFeatures = json_decode($layer->getTranslation('features_json', $locale, false) ?? '[]', true) ?? [];
            if (empty($locFeatures)) $locFeatures = $enFeatures;
          @endphp
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}"
               id="feat-{{ str_replace('-','_',$locale) }}" role="tabpanel">
            <div class="feat-lang-container" data-locale="{{ $locale }}">
              @foreach($locFeatures as $i => $feat)
              <div class="feature-row p-3 mb-2" style="background:var(--wise-canvas-soft);border-radius:var(--wise-r-md)" data-feat-index="{{ $i }}">
                <div class="row g-2 align-items-center">
                  <div class="col-md-{{ $locale === 'en' ? '3' : '4' }}">
                    <input type="text" name="features[{{ $locale }}][{{ $i }}][title]" class="form-control form-control-sm"
                           placeholder="Title ({{ strtoupper($locale) }})" value="{{ $feat['title'] ?? '' }}">
                  </div>
                  @if($locale === 'en')
                  <div class="col-md-2">
                    <input type="text" name="features[{{ $locale }}][{{ $i }}][icon_svg]" class="form-control form-control-sm"
                           placeholder="Icon SVG" value="{{ $feat['icon_svg'] ?? '' }}">
                  </div>
                  @endif
                  <div class="col-md-{{ $locale === 'en' ? '6' : '7' }}">
                    <input type="text" name="features[{{ $locale }}][{{ $i }}][description]" class="form-control form-control-sm"
                           placeholder="Description ({{ strtoupper($locale) }})" value="{{ $feat['description'] ?? '' }}">
                  </div>
                  @if($locale === 'en')
                  <div class="col-md-1">
                    <button type="button" class="btn btn-wise-danger btn-sm w-100 remove-feat">✕</button>
                  </div>
                  @endif
                </div>
              </div>
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
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ $layer->is_active ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Active</label>
        </div>
        <button type="submit" class="btn btn-accent w-100">Save Changes</button>
        <a href="{{ route('admin.architecture.index') }}" class="btn btn-wise-secondary w-100 mt-2">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
const allLocales = ['en','ja','ko','es','zh-TW','vi'];
let fi = {{ count($enFeatures) }};

document.getElementById('add-feature').addEventListener('click', () => {
  allLocales.forEach(locale => {
    const safeLocale = locale.replace('-','_');
    const container = document.querySelector(`.feat-lang-container[data-locale="${locale}"]`);
    if (!container) return;

    const isEn = locale === 'en';
    const iconCol = isEn
      ? `<div class="col-md-2"><input type="text" name="features[${locale}][${fi}][icon_svg]" class="form-control form-control-sm" placeholder="Icon SVG"></div>`
      : '';
    const removeBtn = isEn ? `<div class="col-md-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-feat">✕</button></div>` : '';
    const titleCols = isEn ? 3 : 4;
    const descCols  = isEn ? 6 : 7;

    container.insertAdjacentHTML('beforeend', `
      <div class="feature-row p-3 mb-2" style="background:var(--wise-canvas-soft);border-radius:var(--wise-r-md)" data-feat-index="${fi}">
        <div class="row g-2 align-items-center">
          <div class="col-md-${titleCols}"><input type="text" name="features[${locale}][${fi}][title]" class="form-control form-control-sm" placeholder="Title (${locale.toUpperCase()})"></div>
          ${iconCol}
          <div class="col-md-${descCols}"><input type="text" name="features[${locale}][${fi}][description]" class="form-control form-control-sm" placeholder="Description"></div>
          ${removeBtn}
        </div>
      </div>`);
  });
  fi++;
});

document.addEventListener('click', e => {
  if (!e.target.classList.contains('remove-feat')) return;
  const enRow = e.target.closest('.feature-row');
  const idx   = enRow ? enRow.dataset.featIndex : null;
  if (!idx) return;
  // Remove matching row from all locale containers
  document.querySelectorAll(`.feature-row[data-feat-index="${idx}"]`).forEach(r => r.remove());
});
</script>
@endsection
