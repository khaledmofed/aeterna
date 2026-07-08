@extends('layouts.admin')
@section('title','Edit User')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Admin Users</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">Edit User</h1></div>

<div class="row">
  <div class="col-lg-6">
    <div class="admin-card p-4">
      <form method="POST" action="{{ route('admin.users.update', $user) }}">
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
        <div class="mb-3">
          <label class="form-label">New Password <small class="text-muted">(leave blank to keep current password)</small></label>
          <input type="password" name="password" class="form-control" autocomplete="new-password">
          @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm New Password</label>
          <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_admin" value="1" id="is_admin"
                 {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                 {{ $user->id === auth()->id() ? 'disabled' : '' }}>
          <label class="form-check-label" for="is_admin">Grant admin access</label>
          @if($user->id === auth()->id())
            <input type="hidden" name="is_admin" value="1">
            <small class="text-muted d-block mt-1">You cannot change your own admin status.</small>
          @endif
        </div>
        <button type="submit" class="btn btn-accent px-4">Save Changes</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-wise-secondary px-4">Cancel</a>
      </form>
    </div>
  </div>
</div>
@endsection
