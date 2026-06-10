@extends('layouts.admin')
@section('title','Settings')
@section('breadcrumb')<li class="breadcrumb-item active">Settings</li>@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">Site Settings</h1></div>

<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf
  <div class="row g-4">
    <!-- General -->
    <div class="col-lg-6">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">
          <i class="bi bi-globe me-2" style="color:var(--wise-mute)"></i>General
        </h6>
        @foreach(['site_name'=>'Site Name','site_tagline'=>'Tagline','logo_url'=>'Logo URL','favicon_url'=>'Favicon URL'] as $key => $label)
        <div class="mb-3">
          <label class="form-label">{{ $label }}</label>
          <input type="text" name="{{ $key }}" class="form-control" value="{{ old($key, $settings[$key]->value ?? '') }}">
        </div>
        @endforeach
      </div>

      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">
          <i class="bi bi-search me-2" style="color:var(--wise-mute)"></i>SEO
        </h6>
        <div class="mb-3">
          <label class="form-label">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $settings['meta_title']->value ?? '') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Meta Description</label>
          <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $settings['meta_description']->value ?? '') }}</textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">OG Image URL</label>
          <input type="text" name="og_image_url" class="form-control" value="{{ old('og_image_url', $settings['og_image_url']->value ?? '') }}">
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">
          <i class="bi bi-share me-2" style="color:var(--wise-mute)"></i>Social Links
        </h6>
        @foreach(['twitter_url'=>'Twitter/X URL','discord_url'=>'Discord URL','telegram_url'=>'Telegram URL','github_url'=>'GitHub URL'] as $key => $label)
        <div class="mb-3">
          <label class="form-label">{{ $label }}</label>
          <input type="text" name="{{ $key }}" class="form-control" value="{{ old($key, $settings[$key]->value ?? '') }}">
        </div>
        @endforeach
      </div>

      <div class="admin-card p-4 mb-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">
          <i class="bi bi-bar-chart me-2" style="color:var(--wise-mute)"></i>Analytics
        </h6>
        <div class="mb-3">
          <label class="form-label">Google Analytics ID</label>
          <input type="text" name="ga_id" class="form-control" placeholder="G-XXXXXXXXXX"
                 value="{{ old('ga_id', $settings['ga_id']->value ?? '') }}">
        </div>
      </div>

      <div class="admin-card p-4">
        <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">
          <i class="bi bi-wrench me-2" style="color:var(--wise-mute)"></i>Maintenance
        </h6>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="maintenance_mode" value="1" id="mm"
                 {{ (($settings['maintenance_mode']->value ?? '0') === '1') ? 'checked' : '' }}>
          <label class="form-check-label" for="mm">Enable Maintenance Mode</label>
        </div>
        <small style="color:var(--wise-mute);font-size:.8rem" class="d-block mt-2">
          When enabled, only admins can access the site.
        </small>
      </div>
    </div>
  </div>

  <!-- Custom Code -->
  <div class="row g-4 mt-0">
    <div class="col-12">
      <div class="admin-card p-4">
        <h6 class="fw-semibold mb-1" style="color:var(--wise-ink)">
          <i class="bi bi-code-slash me-2" style="color:var(--wise-mute)"></i>Custom Code
        </h6>
        <p class="text-muted small mb-4">Injected into every page. CSS goes inside &lt;style&gt;, JS inside &lt;script&gt;.</p>
        <div class="row g-4">
          <div class="col-lg-6">
            <label class="form-label fw-semibold">Custom CSS</label>
            <textarea name="custom_css" id="custom_css_editor" class="form-control font-monospace" rows="12"
              placeholder="/* your custom CSS */"
              style="font-size:13px;resize:vertical">{{ old('custom_css', $settings['custom_css']->value ?? '') }}</textarea>
          </div>
          <div class="col-lg-6">
            <label class="form-label fw-semibold">Custom JavaScript</label>
            <textarea name="custom_js" id="custom_js_editor" class="form-control font-monospace" rows="12"
              placeholder="// your custom JS (no script tags needed)"
              style="font-size:13px;resize:vertical">{{ old('custom_js', $settings['custom_js']->value ?? '') }}</textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <button type="submit" class="btn btn-accent px-5">Save All Settings</button>
  </div>
</form>
@endsection
