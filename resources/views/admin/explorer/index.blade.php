@extends('layouts.admin')
@section('title', 'Explorer Pages')
@section('breadcrumb')<li class="breadcrumb-item active">Explorer Pages</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Explorer Pages</h1>
</div>

<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead>
        <tr>
          <th>Slug</th>
          <th>Title</th>
          <th>Tag</th>
          <th>Order</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($pages as $page)
        <tr>
          <td class="text-muted-cell" style="font-family:monospace;font-size:.82rem">{{ $page->slug }}</td>
          <td style="font-weight:600">{{ $page->title }}</td>
          <td>
            <span class="wise-badge wise-badge-primary">{{ $page->tag }}</span>
          </td>
          <td class="text-muted-cell">{{ $page->sort_order }}</td>
          <td>
            <span class="wise-badge {{ $page->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}">
              {{ $page->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.explorer.edit', $page) }}" class="btn btn-wise-outline btn-sm">Edit</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-4" style="color:var(--wise-mute)">
            No explorer pages found. Run <code>php artisan db:seed --class=ExplorerSeeder</code> to seed them.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
