@extends('layouts.admin')
@section('title','Admin Users')
@section('breadcrumb')<li class="breadcrumb-item active">Admin Users</li>@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <h1 class="admin-section-title">Admin Users</h1>
  <a href="{{ route('admin.users.create') }}" class="btn btn-accent">
    <i class="bi bi-plus-lg me-1"></i>Add Admin
  </a>
</div>

<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
        <tr>
          <td>{{ $u->name }}</td>
          <td class="text-muted-cell">{{ $u->email }}</td>
          <td>
            @if($u->is_admin)
              <span class="wise-badge wise-badge-primary">Admin</span>
            @else
              <span class="wise-badge wise-badge-inactive">User</span>
            @endif
          </td>
          <td class="text-end">
            <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-wise-outline btn-sm">Edit</a>
            @if($u->id !== auth()->id())
            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="d-inline"
                  onsubmit="return confirm('Delete {{ $u->name }}? This cannot be undone.');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-wise-danger btn-sm">Delete</button>
            </form>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center text-muted-cell py-4">No users found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
