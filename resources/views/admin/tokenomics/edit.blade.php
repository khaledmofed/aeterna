@extends('layouts.admin')
@section('title','Tokenomics')
@section('breadcrumb')<li class="breadcrumb-item active">Tokenomics</li>@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">Tokenomics</h1></div>

<form method="POST" action="{{ route('admin.tokenomics.update') }}">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <!-- Section info -->
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-3" style="color:var(--wise-ink)">Section Content</h6>
        <div class="mb-3">
          <label class="form-label">Badge Text</label>
          <input type="text" name="section_badge" class="form-control" value="{{ old('section_badge', $tokenomics->section_badge) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Section Title</label>
          <input type="text" name="section_title" class="form-control" value="{{ old('section_title', $tokenomics->section_title) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Subtitle</label>
          <textarea name="section_subtitle" class="form-control" rows="2">{{ old('section_subtitle', $tokenomics->section_subtitle) }}</textarea>
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

      <!-- Allocation -->
      <div class="admin-card p-4 mb-4">
        <div class="d-flex justify-content-between mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Allocation</h6>
          <button type="button" class="btn btn-wise-secondary btn-sm" id="add-alloc">+ Add</button>
        </div>
        <div id="alloc-container">
          @foreach(old('allocation', $tokenomics->allocation_json ?? []) as $i => $a)
          <div class="row g-2 mb-2 alloc-row">
            <div class="col-5"><input type="text" name="allocation[{{ $i }}][label]" class="form-control form-control-sm" placeholder="Label" value="{{ $a['label'] ?? '' }}"></div>
            <div class="col-3"><input type="number" name="allocation[{{ $i }}][percentage]" class="form-control form-control-sm" placeholder="%" value="{{ $a['percentage'] ?? '' }}"></div>
            <div class="col-3"><input type="color" name="allocation[{{ $i }}][color]" class="form-control form-control-sm form-control-color w-100" value="{{ $a['color'] ?? '#9fe870' }}"></div>
            <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-row">✕</button></div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Flywheel steps -->
      <div class="admin-card p-4">
        <div class="d-flex justify-content-between mb-3">
          <h6 class="fw-semibold mb-0" style="color:var(--wise-ink)">Flywheel Steps</h6>
          <button type="button" class="btn btn-wise-secondary btn-sm" id="add-fly">+ Add</button>
        </div>
        <div id="fly-container">
          @foreach(old('flywheel_steps', $tokenomics->flywheel_steps_json ?? []) as $i => $step)
          <div class="d-flex gap-2 mb-2 fly-row">
            <input type="text" name="flywheel_steps[{{ $i }}]" class="form-control form-control-sm" value="{{ $step }}">
            <button type="button" class="btn btn-wise-danger btn-sm remove-row">✕</button>
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
let ai = {{ count($tokenomics->allocation_json ?? []) }};
let fi = {{ count($tokenomics->flywheel_steps_json ?? []) }};
document.getElementById('add-alloc').addEventListener('click', () => {
  document.getElementById('alloc-container').insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 alloc-row">
    <div class="col-5"><input type="text" name="allocation[${ai}][label]" class="form-control form-control-sm" placeholder="Label"></div>
    <div class="col-3"><input type="number" name="allocation[${ai}][percentage]" class="form-control form-control-sm" placeholder="%"></div>
    <div class="col-3"><input type="color" name="allocation[${ai}][color]" class="form-control form-control-sm form-control-color w-100" value="#9fe870"></div>
    <div class="col-1"><button type="button" class="btn btn-wise-danger btn-sm w-100 remove-row">✕</button></div>
  </div>`);
  ai++;
});
document.getElementById('add-fly').addEventListener('click', () => {
  document.getElementById('fly-container').insertAdjacentHTML('beforeend', `<div class="d-flex gap-2 mb-2 fly-row">
    <input type="text" name="flywheel_steps[${fi}]" class="form-control form-control-sm">
    <button type="button" class="btn btn-wise-danger btn-sm remove-row">✕</button>
  </div>`);
  fi++;
});
document.addEventListener('click', e => {
  if (e.target.classList.contains('remove-row')) e.target.closest('.alloc-row,.fly-row').remove();
});
</script>
@endsection
