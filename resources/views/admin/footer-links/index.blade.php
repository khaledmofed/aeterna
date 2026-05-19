@extends('layouts.admin')
@section('title','Footer Links')
@section('breadcrumb')<li class="breadcrumb-item active">Footer Links</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Footer Links</h1>
  <a href="{{ route('admin.footer-links.create') }}" class="btn btn-accent btn-sm px-4">+ Add Link</a>
</div>
@foreach($links as $group => $groupLinks)
<div class="admin-card p-0 mb-4">
  <div class="wise-card-header">{{ $group }}</div>
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead><tr>
        <th>Label</th>
        <th>URL</th>
        <th>Order</th>
        <th>Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @foreach($groupLinks as $link)
        <tr>
          <td>{{ $link->label }}</td>
          <td class="text-muted-cell" style="font-family:monospace;font-size:.8rem">{{ $link->url }}</td>
          <td class="text-muted-cell">{{ $link->sort_order }}</td>
          <td>
            <span class="wise-badge {{ $link->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}">
              {{ $link->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.footer-links.edit', $link) }}" class="btn btn-wise-outline btn-sm me-1">Edit</a>
            <form method="POST" action="{{ route('admin.footer-links.destroy', $link) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-wise-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endforeach
@endsection
