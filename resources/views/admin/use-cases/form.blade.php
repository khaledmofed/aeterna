@extends('layouts.admin')
@section('title', isset($useCase) ? 'Edit Use Case' : 'New Use Case')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.use-cases.index') }}">Use Cases</a></li>
  <li class="breadcrumb-item active">{{ isset($useCase) ? 'Edit' : 'New' }}</li>
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
$tabPrefix = 'uc';
@endphp
<div class="mb-4"><h1 class="admin-section-title">{{ isset($useCase) ? 'Edit Use Case' : 'New Use Case' }}</h1></div>

<form method="POST" action="{{ isset($useCase) ? route('admin.use-cases.update', $useCase) : route('admin.use-cases.store') }}">
  @csrf @if(isset($useCase)) @method('PUT') @endif
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4 mb-4">
        @include('admin.partials.lang-tabs')
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}"
               id="{{ $tabPrefix }}-{{ str_replace('-','_',$locale) }}" role="tabpanel">
            <div class="mb-3">
              <label class="form-label">Title <span class="text-muted small">({{ $lang['flag'] }})</span>{{ $locale === 'en' ? ' *' : '' }}</label>
              <input type="text" name="title[{{ $locale }}]" class="form-control"
                     value="{{ old('title.'.$locale, isset($useCase) ? $useCase->getTranslation('title', $locale, false) : '') }}"
                     {{ $locale === 'en' ? 'required' : '' }}>
            </div>
            <div class="mb-2">
              <label class="form-label">Description <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <textarea name="description[{{ $locale }}]" class="form-control" rows="4">{{ old('description.'.$locale, isset($useCase) ? $useCase->getTranslation('description', $locale, false) : '') }}</textarea>
            </div>
          </div>
          @endforeach
        </div>
        <hr class="my-3">
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
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Features</h6>
          <button type="button" id="add-feat" class="btn btn-wise-secondary btn-sm">+ Add (EN)</button>
        </div>
        @php $ucEnFeats = json_decode(isset($useCase) ? ($useCase->getTranslation('features_json','en',false) ?? '[]') : '[]', true) ?? []; @endphp
        <ul class="nav nav-pills mb-3 flex-wrap gap-1">
          @foreach($langs as $locale => $lang)
          <li class="nav-item">
            <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                    data-bs-toggle="pill" data-bs-target="#ucfeat-{{ str_replace('-','_',$locale) }}" type="button">
              {{ $lang['flag'] }} {{ $lang['name'] }}
            </button>
          </li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          @php $locFeats = json_decode(isset($useCase) ? ($useCase->getTranslation('features_json',$locale,false) ?? '[]') : '[]', true) ?? $ucEnFeats; @endphp
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}" id="ucfeat-{{ str_replace('-','_',$locale) }}">
            <div class="uc-feat-container" data-locale="{{ $locale }}">
              @foreach($locFeats as $i => $f)
              <div class="row g-2 mb-2 uc-feat-row" data-feat-index="{{ $i }}">
                <div class="col-4"><input type="text" name="features[{{ $locale }}][{{ $i }}][title]" class="form-control form-control-sm" placeholder="Title" value="{{ $f['title'] ?? '' }}"></div>
                <div class="col-{{ $locale === 'en' ? '7' : '8' }}"><input type="text" name="features[{{ $locale }}][{{ $i }}][description]" class="form-control form-control-sm" placeholder="Description" value="{{ $f['description'] ?? '' }}"></div>
                @if($locale === 'en')
                <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-uc-feat">✕</button></div>
                @endif
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
const ucLocales = ['en','ja','ko','es','zh-TW','vi'];
let ucfi = {{ count($ucEnFeats) }};

document.getElementById('add-feat').addEventListener('click', () => {
  ucLocales.forEach(locale => {
    const c = document.querySelector(`.uc-feat-container[data-locale="${locale}"]`);
    if (!c) return;
    const isEn = locale === 'en';
    const removeBtn = isEn ? `<div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-uc-feat">✕</button></div>` : '';
    c.insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 uc-feat-row" data-feat-index="${ucfi}">
      <div class="col-4"><input type="text" name="features[${locale}][${ucfi}][title]" class="form-control form-control-sm" placeholder="Title"></div>
      <div class="col-${isEn?7:8}"><input type="text" name="features[${locale}][${ucfi}][description]" class="form-control form-control-sm" placeholder="Description"></div>
      ${removeBtn}
    </div>`);
  });
  ucfi++;
});

document.addEventListener('click', e => {
  if (!e.target.classList.contains('remove-uc-feat')) return;
  const row = e.target.closest('.uc-feat-row');
  const idx = row?.dataset.featIndex;
  document.querySelectorAll(`.uc-feat-row[data-feat-index="${idx}"]`).forEach(r => r.remove());
});
</script>
@endsection
