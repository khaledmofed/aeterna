@extends('layouts.admin')
@section('title','Tokenomics')
@section('breadcrumb')<li class="breadcrumb-item active">Tokenomics</li>@endsection

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
$tabPrefix = 'tok';
$enAlloc    = json_decode($tokenomics->getTranslation('allocation_json','en',false) ?? '[]', true) ?? [];
$enStats    = json_decode($tokenomics->getTranslation('stats_json','en',false) ?? '[]', true) ?? [];
$enFlywheel = json_decode($tokenomics->getTranslation('flywheel_steps_json','en',false) ?? '[]', true) ?? [];
$enMechanics= json_decode($tokenomics->getTranslation('mechanics_json','en',false) ?? '[]', true) ?? [];
@endphp
<div class="mb-4"><h1 class="admin-section-title">Tokenomics</h1></div>

<form method="POST" action="{{ route('admin.tokenomics.update') }}">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <!-- Section info (translatable) -->
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-3" style="color:var(--wise-ink)">Section Content</h6>
        @include('admin.partials.lang-tabs')
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}"
               id="{{ $tabPrefix }}-{{ str_replace('-','_',$locale) }}" role="tabpanel">
            <div class="mb-3">
              <label class="form-label">Badge Text <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <input type="text" name="section_badge[{{ $locale }}]" class="form-control"
                     value="{{ old('section_badge.'.$locale, $tokenomics->getTranslation('section_badge', $locale, false)) }}">
            </div>
            <div class="mb-3">
              <label class="form-label">Section Title <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <input type="text" name="section_title[{{ $locale }}]" class="form-control"
                     value="{{ old('section_title.'.$locale, $tokenomics->getTranslation('section_title', $locale, false)) }}">
            </div>
            <div class="mb-3">
              <label class="form-label">Subtitle <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <textarea name="section_subtitle[{{ $locale }}]" class="form-control" rows="2">{{ old('section_subtitle.'.$locale, $tokenomics->getTranslation('section_subtitle', $locale, false)) }}</textarea>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Token info -->
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-3" style="color:var(--wise-ink)">Token Info</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Token Name</label>
            <input type="text" name="token_name" class="form-control" value="{{ old('token_name', $tokenomics->token_name) }}">
          </div>
          <div class="col-md-2">
            <label class="form-label">Ticker</label>
            <input type="text" name="token_ticker" class="form-control" value="{{ old('token_ticker', $tokenomics->token_ticker) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Total Supply</label>
            <input type="text" name="token_supply" class="form-control" value="{{ old('token_supply', $tokenomics->token_supply) }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">LP Token Name</label>
            <input type="text" name="lp_token_name" class="form-control" value="{{ old('lp_token_name', $tokenomics->lp_token_name) }}">
          </div>
          <div class="col-md-8">
            <label class="form-label">LP Token Description</label>
            <textarea name="lp_token_description" class="form-control" rows="2">{{ old('lp_token_description', $tokenomics->lp_token_description) }}</textarea>
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div class="admin-card p-4 mb-4">
        <div class="d-flex justify-content-between mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Stats (Hero Grid)</h6>
          <button type="button" class="btn btn-wise-secondary btn-sm" id="add-stat">+ Add (EN)</button>
        </div>
        <ul class="nav nav-pills mb-3 flex-wrap gap-1" id="stats-lang-tabs">
          @foreach($langs as $locale => $lang)
          <li class="nav-item">
            <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                    data-bs-toggle="pill" data-bs-target="#stats-{{ str_replace('-','_',$locale) }}" type="button">
              {{ $lang['flag'] }} {{ $lang['name'] }}
            </button>
          </li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          @php $locStats = json_decode($tokenomics->getTranslation('stats_json',$locale,false) ?? '[]', true) ?? $enStats; @endphp
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}" id="stats-{{ str_replace('-','_',$locale) }}">
            <div class="stat-lang-container" data-locale="{{ $locale }}">
              @foreach($locStats as $i => $stat)
              <div class="row g-2 mb-2 stat-row" data-stat-index="{{ $i }}">
                @if($locale === 'en')
                <div class="col-3"><input type="text" name="stats[en][{{ $i }}][value]" class="form-control form-control-sm" placeholder="Value" value="{{ $stat['value'] ?? '' }}"></div>
                @else
                <div class="col-3"><span class="form-control form-control-sm bg-light text-muted" style="line-height:1.5">{{ $enStats[$i]['value'] ?? '' }}</span></div>
                @endif
                <div class="col-4"><input type="text" name="stats[{{ $locale }}][{{ $i }}][label]" class="form-control form-control-sm" placeholder="Label" value="{{ $stat['label'] ?? '' }}"></div>
                <div class="col-{{ $locale === 'en' ? '4' : '5' }}"><input type="text" name="stats[{{ $locale }}][{{ $i }}][description]" class="form-control form-control-sm" placeholder="Description" value="{{ $stat['description'] ?? '' }}"></div>
                @if($locale === 'en')
                <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-stat">✕</button></div>
                @endif
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Allocation -->
      <div class="admin-card p-4 mb-4">
        <div class="d-flex justify-content-between mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Allocation</h6>
          <button type="button" class="btn btn-wise-secondary btn-sm" id="add-alloc">+ Add (EN)</button>
        </div>
        <ul class="nav nav-pills mb-3 flex-wrap gap-1">
          @foreach($langs as $locale => $lang)
          <li class="nav-item">
            <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                    data-bs-toggle="pill" data-bs-target="#alloc-{{ str_replace('-','_',$locale) }}" type="button">
              {{ $lang['flag'] }} {{ $lang['name'] }}
            </button>
          </li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          @php $locAlloc = json_decode($tokenomics->getTranslation('allocation_json',$locale,false) ?? '[]', true) ?? $enAlloc; @endphp
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}" id="alloc-{{ str_replace('-','_',$locale) }}">
            <div class="alloc-lang-container" data-locale="{{ $locale }}">
              @foreach($locAlloc as $i => $a)
              <div class="row g-2 mb-2 alloc-row" data-alloc-index="{{ $i }}">
                <div class="col-5"><input type="text" name="allocation[{{ $locale }}][{{ $i }}][label]" class="form-control form-control-sm" placeholder="Label" value="{{ $a['label'] ?? '' }}"></div>
                @if($locale === 'en')
                <div class="col-3"><input type="number" name="allocation[en][{{ $i }}][percentage]" class="form-control form-control-sm" placeholder="%" value="{{ $a['percentage'] ?? '' }}"></div>
                <div class="col-3"><input type="color" name="allocation[en][{{ $i }}][color]" class="form-control form-control-sm form-control-color w-100" value="{{ $a['color'] ?? '#9fe870' }}"></div>
                <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-alloc">✕</button></div>
                @else
                <div class="col-3"><span class="form-control form-control-sm bg-light text-muted" style="line-height:1.5">{{ $enAlloc[$i]['percentage'] ?? '' }}%</span></div>
                @endif
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Flywheel steps -->
      <div class="admin-card p-4 mb-4">
        <div class="d-flex justify-content-between mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Flywheel Steps</h6>
          <button type="button" class="btn btn-wise-secondary btn-sm" id="add-fly">+ Add (EN)</button>
        </div>
        <ul class="nav nav-pills mb-3 flex-wrap gap-1">
          @foreach($langs as $locale => $lang)
          <li class="nav-item">
            <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                    data-bs-toggle="pill" data-bs-target="#fly-{{ str_replace('-','_',$locale) }}" type="button">
              {{ $lang['flag'] }} {{ $lang['name'] }}
            </button>
          </li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          @php $locFly = json_decode($tokenomics->getTranslation('flywheel_steps_json',$locale,false) ?? '[]', true) ?? $enFlywheel; @endphp
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}" id="fly-{{ str_replace('-','_',$locale) }}">
            <div class="fly-lang-container" data-locale="{{ $locale }}">
              @foreach($locFly as $i => $step)
              <div class="d-flex gap-2 mb-2 fly-row" data-fly-index="{{ $i }}">
                <input type="text" name="flywheel_steps[{{ $locale }}][{{ $i }}]" class="form-control form-control-sm" value="{{ $step }}">
                @if($locale === 'en')
                <button type="button" class="btn btn-wise-danger btn-sm remove-fly">✕</button>
                @endif
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Mechanics -->
      <div class="admin-card p-4">
        <div class="d-flex justify-content-between mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Mechanics</h6>
          <button type="button" class="btn btn-wise-secondary btn-sm" id="add-mech">+ Add (EN)</button>
        </div>
        <ul class="nav nav-pills mb-3 flex-wrap gap-1">
          @foreach($langs as $locale => $lang)
          <li class="nav-item">
            <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                    data-bs-toggle="pill" data-bs-target="#mech-{{ str_replace('-','_',$locale) }}" type="button">
              {{ $lang['flag'] }} {{ $lang['name'] }}
            </button>
          </li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          @php $locMech = json_decode($tokenomics->getTranslation('mechanics_json',$locale,false) ?? '[]', true) ?? $enMechanics; @endphp
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}" id="mech-{{ str_replace('-','_',$locale) }}">
            <div class="mech-lang-container" data-locale="{{ $locale }}">
              @foreach($locMech as $i => $mech)
              <div class="p-3 mb-2 mech-row" data-mech-index="{{ $i }}" style="background:var(--wise-canvas-soft);border-radius:var(--wise-r-md)">
                <div class="row g-2">
                  <div class="col-4"><input type="text" name="mechanics[{{ $locale }}][{{ $i }}][title]" class="form-control form-control-sm" placeholder="Title" value="{{ $mech['title'] ?? '' }}"></div>
                  <div class="col-{{ $locale === 'en' ? '7' : '8' }}"><input type="text" name="mechanics[{{ $locale }}][{{ $i }}][description]" class="form-control form-control-sm" placeholder="Description" value="{{ $mech['description'] ?? '' }}"></div>
                  @if($locale === 'en')
                  <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-mech">✕</button></div>
                  @endif
                  @if($locale === 'en')
                  <div class="col-12"><input type="text" name="mechanics[en][{{ $i }}][icon_svg]" class="form-control form-control-sm" placeholder="Icon SVG path" value="{{ $mech['icon_svg'] ?? '' }}"></div>
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
        <button type="submit" class="btn btn-accent w-100">Save Tokenomics</button>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
const tokLocales = ['en','ja','ko','es','zh-TW','vi'];
let ai = {{ count($enAlloc) }};
let si = {{ count($enStats) }};
let fi = {{ count($enFlywheel) }};
let mi = {{ count($enMechanics) }};

document.getElementById('add-alloc').addEventListener('click', () => {
  tokLocales.forEach(locale => {
    const c = document.querySelector(`.alloc-lang-container[data-locale="${locale}"]`);
    if (!c) return;
    const isEn = locale === 'en';
    const extra = isEn
      ? `<div class="col-3"><input type="number" name="allocation[en][${ai}][percentage]" class="form-control form-control-sm" placeholder="%"></div>
         <div class="col-3"><input type="color" name="allocation[en][${ai}][color]" class="form-control form-control-sm form-control-color w-100" value="#9fe870"></div>
         <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-alloc">✕</button></div>`
      : `<div class="col-3"><span class="form-control form-control-sm bg-light text-muted" style="line-height:1.5">—</span></div>`;
    c.insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 alloc-row" data-alloc-index="${ai}">
      <div class="col-5"><input type="text" name="allocation[${locale}][${ai}][label]" class="form-control form-control-sm" placeholder="Label"></div>
      ${extra}
    </div>`);
  });
  ai++;
});

document.getElementById('add-stat').addEventListener('click', () => {
  tokLocales.forEach(locale => {
    const c = document.querySelector(`.stat-lang-container[data-locale="${locale}"]`);
    if (!c) return;
    const isEn = locale === 'en';
    const valCol = isEn
      ? `<div class="col-3"><input type="text" name="stats[en][${si}][value]" class="form-control form-control-sm" placeholder="Value"></div>`
      : `<div class="col-3"><span class="form-control form-control-sm bg-light text-muted" style="line-height:1.5">—</span></div>`;
    const removeBtn = isEn ? `<div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-stat">✕</button></div>` : '';
    c.insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 stat-row" data-stat-index="${si}">
      ${valCol}
      <div class="col-4"><input type="text" name="stats[${locale}][${si}][label]" class="form-control form-control-sm" placeholder="Label"></div>
      <div class="col-${isEn?4:5}"><input type="text" name="stats[${locale}][${si}][description]" class="form-control form-control-sm" placeholder="Description"></div>
      ${removeBtn}
    </div>`);
  });
  si++;
});

document.getElementById('add-fly').addEventListener('click', () => {
  tokLocales.forEach(locale => {
    const c = document.querySelector(`.fly-lang-container[data-locale="${locale}"]`);
    if (!c) return;
    const btn = locale === 'en' ? `<button type="button" class="btn btn-wise-danger btn-sm remove-fly">✕</button>` : '';
    c.insertAdjacentHTML('beforeend', `<div class="d-flex gap-2 mb-2 fly-row" data-fly-index="${fi}">
      <input type="text" name="flywheel_steps[${locale}][${fi}]" class="form-control form-control-sm">
      ${btn}
    </div>`);
  });
  fi++;
});

document.getElementById('add-mech').addEventListener('click', () => {
  tokLocales.forEach(locale => {
    const c = document.querySelector(`.mech-lang-container[data-locale="${locale}"]`);
    if (!c) return;
    const isEn = locale === 'en';
    const iconRow = isEn ? `<div class="col-12"><input type="text" name="mechanics[en][${mi}][icon_svg]" class="form-control form-control-sm" placeholder="Icon SVG path"></div>` : '';
    const removeBtn = isEn ? `<div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-mech">✕</button></div>` : '';
    c.insertAdjacentHTML('beforeend', `<div class="p-3 mb-2 mech-row" data-mech-index="${mi}" style="background:var(--wise-canvas-soft);border-radius:var(--wise-r-md)">
      <div class="row g-2">
        <div class="col-4"><input type="text" name="mechanics[${locale}][${mi}][title]" class="form-control form-control-sm" placeholder="Title"></div>
        <div class="col-${isEn?7:8}"><input type="text" name="mechanics[${locale}][${mi}][description]" class="form-control form-control-sm" placeholder="Description"></div>
        ${removeBtn}
        ${iconRow}
      </div>
    </div>`);
  });
  mi++;
});

document.addEventListener('click', e => {
  if (e.target.classList.contains('remove-alloc')) {
    const row = e.target.closest('.alloc-row');
    const idx = row?.dataset.allocIndex;
    document.querySelectorAll(`.alloc-row[data-alloc-index="${idx}"]`).forEach(r => r.remove());
  }
  if (e.target.classList.contains('remove-stat')) {
    const row = e.target.closest('.stat-row');
    const idx = row?.dataset.statIndex;
    document.querySelectorAll(`.stat-row[data-stat-index="${idx}"]`).forEach(r => r.remove());
  }
  if (e.target.classList.contains('remove-fly')) {
    const row = e.target.closest('.fly-row');
    const idx = row?.dataset.flyIndex;
    document.querySelectorAll(`.fly-row[data-fly-index="${idx}"]`).forEach(r => r.remove());
  }
  if (e.target.classList.contains('remove-mech')) {
    const row = e.target.closest('.mech-row');
    const idx = row?.dataset.mechIndex;
    document.querySelectorAll(`.mech-row[data-mech-index="${idx}"]`).forEach(r => r.remove());
  }
});
</script>
@endsection
