@extends('layouts.admin')
@section('title','My Account')
@section('breadcrumb')<li class="breadcrumb-item active">My Account</li>@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">My Account</h1></div>

<div class="row g-4">
  <div class="col-lg-6">
    <div class="admin-card p-4 mb-4">
      <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">
        <i class="bi bi-person me-2" style="color:var(--wise-mute)"></i>Profile
      </h6>
      <form method="POST" action="{{ route('admin.account.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
          @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-accent px-4">Save Changes</button>
      </form>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="admin-card p-4 mb-4">
      <h6 class="fw-semibold mb-4" style="color:var(--wise-ink)">
        <i class="bi bi-shield-lock me-2" style="color:var(--wise-mute)"></i>Change Password
      </h6>
      <form method="POST" action="{{ route('admin.account.password') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">Current Password</label>
          <input type="password" name="current_password" class="form-control" autocomplete="current-password">
          @error('current_password', 'updatePassword')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">New Password</label>
          <input type="password" name="password" class="form-control" autocomplete="new-password">
          @error('password', 'updatePassword')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm New Password</label>
          <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-accent px-4">Update Password</button>
      </form>
    </div>
  </div>
</div>
@endsection
