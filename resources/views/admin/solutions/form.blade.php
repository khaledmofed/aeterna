@extends('layouts.admin')
@section('title', isset($solution->id) ? 'Edit Solution Row' : 'Add Solution Row')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.solutions.index') }}">Solutions</a></li>
  <li class="breadcrumb-item active">{{ isset($solution->id) ? 'Edit' : 'Add' }}</li>
@endsection

@section('content')
<div class="mb-4">
  <h1 class="admin-section-title">{{ isset($solution->id) ? 'Edit Solution Row' : 'Add Solution Row' }}</h1>
</div>

<form method="POST" action="{{ $action }}">
  @csrf
  @if($method === 'PUT') @method('PUT') @endif

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="admin-card p-4">
        <div class="mb-4">
          <label class="form-label fw-semibold">Challenge</label>
          <input type="text" name="challenge" class="form-control @error('challenge') is-invalid @enderror"
                 value="{{ old('challenge', $solution->challenge) }}" placeholder="e.g. Fragmented user experience" required>
          @error('challenge')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
          <label class="form-label fw-semibold">Current State</label>
          <textarea name="current_state" class="form-control @error('current_state') is-invalid @enderror" rows="3"
                    placeholder="e.g. Managing multiple wallets, addresses, and gas tokens" required>{{ old('current_state', $solution->current_state) }}</textarea>
          @error('current_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
          <label class="form-label fw-semibold">Aeterna Solution</label>
          <textarea name="aeterna_solution" class="form-control @error('aeterna_solution') is-invalid @enderror" rows="3"
                    placeholder="e.g. Universal Address controls 15+ chains" required>{{ old('aeterna_solution', $solution->aeterna_solution) }}</textarea>
          @error('aeterna_solution')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
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
