@extends('layouts.admin')
@section('title', isset($stage) ? 'Edit Stage' : 'New Stage')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.roadmap.index') }}">Roadmap</a></li>
  <li class="breadcrumb-item active">{{ isset($stage) ? 'Edit' : 'New' }}</li>
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
$tabPrefix = 'rdm';
@endphp
<div class="mb-4"><h1 class="admin-section-title">{{ isset($stage) ? 'Edit Stage' : 'New Stage' }}</h1></div>

<div class="row"><div class="col-lg-7">
<form method="POST" action="{{ isset($stage) ? route('admin.roadmap.update', $stage) : route('admin.roadmap.store') }}">
  @csrf @if(isset($stage)) @method('PUT') @endif
  <div class="admin-card p-4">
    <div class="mb-3">
      <label class="form-label">Stage #</label>
      <input type="number" name="stage_number" class="form-control" required value="{{ old('stage_number', $stage->stage_number ?? '') }}" style="max-width:120px">
    </div>

    @include('admin.partials.lang-tabs')
    <div class="tab-content mb-3">
      @foreach($langs as $locale => $lang)
      <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}"
           id="{{ $tabPrefix }}-{{ str_replace('-','_',$locale) }}" role="tabpanel">
        <div class="mb-3">
          <label class="form-label">Name <span class="text-muted small">({{ $lang['flag'] }})</span>{{ $locale === 'en' ? ' *' : '' }}</label>
          <input type="text" name="name[{{ $locale }}]" class="form-control"
                 value="{{ old('name.'.$locale, isset($stage) ? $stage->getTranslation('name', $locale, false) : '') }}"
                 {{ $locale === 'en' ? 'required' : '' }}>
        </div>
        <div class="mb-2">
          <label class="form-label">Timeframe <span class="text-muted small">({{ $lang['flag'] }})</span></label>
          <input type="text" name="timeframe[{{ $locale }}]" class="form-control"
                 placeholder="Year 1 — Q1 & Q2"
                 value="{{ old('timeframe.'.$locale, isset($stage) ? $stage->getTranslation('timeframe', $locale, false) : '') }}">
        </div>
      </div>
      @endforeach
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        @foreach(['completed','active','upcoming'] as $s)
          <option value="{{ $s }}" {{ (old('status', $stage->status ?? 'upcoming')) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label fw-semibold">Milestones <small style="color:var(--wise-mute)">(one per line)</small></label>
      <ul class="nav nav-pills mb-2 flex-wrap gap-1">
        @foreach($langs as $locale => $lang)
        <li class="nav-item">
          <button class="nav-link py-1 px-3 {{ $locale === 'en' ? 'active' : '' }}"
                  data-bs-toggle="pill"
                  data-bs-target="#ms-{{ str_replace('-','_',$locale) }}"
                  type="button">{{ $lang['flag'] }} {{ $lang['name'] }}</button>
        </li>
        @endforeach
      </ul>
      <div class="tab-content">
        @foreach($langs as $locale => $lang)
        @php
          $locMs = isset($stage) ? (json_decode($stage->getTranslation('milestones_json',$locale,false) ?? '[]', true) ?? []) : [];
        @endphp
        <div class="tab-pane fade {{ $locale === 'en' ? 'show active' : '' }}" id="ms-{{ str_replace('-','_',$locale) }}">
          <textarea name="milestones[{{ $locale }}]" class="form-control" rows="8"
                    placeholder="{{ $lang['name'] }}: one milestone per line">{{ old('milestones.'.$locale, implode("\n", $locMs)) }}</textarea>
        </div>
        @endforeach
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Sort Order</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $stage->sort_order ?? 0) }}">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
             {{ (old('is_active', $stage->is_active ?? true)) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_active">Active</label>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-accent flex-fill">Save</button>
      <a href="{{ route('admin.roadmap.index') }}" class="btn btn-wise-secondary flex-fill">Cancel</a>
    </div>
  </div>
</form>
</div></div>
@endsection
