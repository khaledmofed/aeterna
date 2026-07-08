@extends('layouts.admin')
@section('title','Add Admin')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Admin Users</a></li>
<li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="mb-4"><h1 class="admin-section-title">Add Admin</h1></div>

<div class="row">
  <div class="col-lg-6">
    <div class="admin-card p-4">
      <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
          @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" autocomplete="new-password" required>
          @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" required>
        </div>
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_admin" value="1" id="is_admin" {{ old('is_admin', true) ? 'checked' : '' }}>
          <label class="form-check-label" for="is_admin">Grant admin access</label>
        </div>
        <button type="submit" class="btn btn-accent px-4">Create User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-wise-secondary px-4">Cancel</a>
      </form>
    </div>
  </div>
</div>
@endsection
