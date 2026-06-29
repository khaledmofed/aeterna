@extends('layouts.admin')
@section('title', isset($solution->id) ? 'Edit Solution Row' : 'Add Solution Row')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.solutions.index') }}">Solutions</a></li>
  <li class="breadcrumb-item active">{{ isset($solution->id) ? 'Edit' : 'Add' }}</li>
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
$tabPrefix = 'sol';
@endphp
<div class="mb-4">
  <h1 class="admin-section-title">{{ isset($solution->id) ? 'Edit Solution Row' : 'Add Solution Row' }}</h1>
</div>

<form method="POST" action="{{ $action }}">
  @csrf
  @if($method === 'PUT') @method('PUT') @endif

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4">
        @include('admin.partials.lang-tabs')
        <div class="tab-content">
          @foreach($langs as $locale => $lang)
          <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}"
               id="{{ $tabPrefix }}-{{ str_replace('-','_',$locale) }}" role="tabpanel">
            <div class="mb-4">
              <label class="form-label fw-semibold">Challenge <span class="text-muted small">({{ $lang['flag'] }})</span>{{ $locale === 'en' ? ' *' : '' }}</label>
              <input type="text" name="challenge[{{ $locale }}]"
                     class="form-control @error('challenge.'.$locale) is-invalid @enderror"
                     value="{{ old('challenge.'.$locale, $solution->getTranslation('challenge', $locale, false)) }}"
                     placeholder="e.g. Fragmented user experience" {{ $locale === 'en' ? 'required' : '' }}>
              @error('challenge.'.$locale)<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
              <label class="form-label fw-semibold">Current State <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <textarea name="current_state[{{ $locale }}]"
                        class="form-control @error('current_state.'.$locale) is-invalid @enderror" rows="3"
                        placeholder="e.g. Managing multiple wallets across chains">{{ old('current_state.'.$locale, $solution->getTranslation('current_state', $locale, false)) }}</textarea>
              @error('current_state.'.$locale)<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
              <label class="form-label fw-semibold">Aeterna Solution <span class="text-muted small">({{ $lang['flag'] }})</span></label>
              <textarea name="aeterna_solution[{{ $locale }}]"
                        class="form-control @error('aeterna_solution.'.$locale) is-invalid @enderror" rows="3"
                        placeholder="e.g. Universal Address controls 15+ chains">{{ old('aeterna_solution.'.$locale, $solution->getTranslation('aeterna_solution', $locale, false)) }}</textarea>
              @error('aeterna_solution.'.$locale)<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          @endforeach
        </div>

        <hr class="my-3">
        <div>
          <label class="form-label fw-semibold">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" style="max-width:120px"
                 value="{{ old('sort_order', $solution->sort_order ?? 0) }}">
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="admin-card p-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">Settings</h6>
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                 {{ old('is_active', $solution->is_active ?? true) ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Active</label>
        </div>
        <button type="submit" class="btn btn-accent w-100">Save</button>
        <a href="{{ route('admin.solutions.index') }}" class="btn btn-wise-secondary w-100 mt-2">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection
