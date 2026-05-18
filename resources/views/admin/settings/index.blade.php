@extends('layouts.admin')
@section('title','Settings')
@section('breadcrumb')<li class="breadcrumb-item active">Settings</li>@endsection

@section('content')
<div class="mb-4"><h1 class="h4 fw-bold text-white mb-0">Site Settings</h1></div>

<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf
  <div class="row g-4">
    <!-- General -->
    <div class="col-lg-6">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold text-white mb-4"><i class="bi bi-globe me-2 text-white-50"></i>General</h6>
        @foreach(['site_name'=>'Site Name','site_tagline'=>'Tagline','logo_url'=>'Logo URL','favicon_url'=>'Favicon URL'] as $key => $label)
        <div class="mb-3"><label class="form-label">{{ $label }}</label>
          <input type="text" name="{{ $key }}" class="form-control" value="{{ old($key, $settings[$key]->value ?? '') }}">
        </div>
        @endforeach
      </div>

      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold text-white mb-4"><i class="bi bi-search me-2 text-white-50"></i>SEO</h6>
        <div class="mb-3"><label class="form-label">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $settings['meta_title']->value ?? '') }}">
        </div>
        <div class="mb-3"><label class="form-label">Meta Description</label>
          <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $settings['meta_description']->value ?? '') }}</textarea>
        </div>
        <div class="mb-3"><label class="form-label">OG Image URL</label>
          <input type="text" name="og_image_url" class="form-control" value="{{ old('og_image_url', $settings['og_image_url']->value ?? '') }}">
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold text-white mb-4"><i class="bi bi-share me-2 text-white-50"></i>Social Links</h6>
        @foreach(['twitter_url'=>'Twitter/X URL','discord_url'=>'Discord URL','telegram_url'=>'Telegram URL','github_url'=>'GitHub URL'] as $key => $label)
        <div class="mb-3"><label class="form-label">{{ $label }}</label>
          <input type="text" name="{{ $key }}" class="form-control" value="{{ old($key, $settings[$key]->value ?? '') }}">
        </div>
        @endforeach
      </div>

      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold text-white mb-4"><i class="bi bi-bar-chart me-2 text-white-50"></i>Analytics</h6>
        <div class="mb-3"><label class="form-label">Google Analytics ID</label>
          <input type="text" name="ga_id" class="form-control" placeholder="G-XXXXXXXXXX" value="{{ old('ga_id', $settings['ga_id']->value ?? '') }}">
        </div>
      </div>

      <div class="admin-card p-4">
        <h6 class="fw-semibold text-white mb-4"><i class="bi bi-wrench me-2 text-white-50"></i>Maintenance</h6>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="maintenance_mode" value="1" id="mm" {{ (($settings['maintenance_mode']->value ?? '0') === '1') ? 'checked' : '' }}>
          <label class="form-check-label text-white-50" for="mm">Enable Maintenance Mode</label>
        </div>
        <small class="text-white-50 d-block mt-2">When enabled, only admins can access the site.</small>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <button type="submit" class="btn btn-accent px-5">Save All Settings</button>
  </div>
</form>
@endsection
