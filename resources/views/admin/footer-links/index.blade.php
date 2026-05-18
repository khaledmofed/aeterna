@extends('layouts.admin')
@section('title','Footer Links')
@section('breadcrumb')<li class="breadcrumb-item active">Footer Links</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Footer Links</h1>
  <a href="{{ route('admin.footer-links.create') }}" class="btn btn-accent btn-sm px-3">+ Add Link</a>
</div>
@foreach($links as $group => $groupLinks)
<div class="admin-card p-0 mb-4">
  <div class="px-4 py-3 border-bottom" style="border-color:rgba(255,255,255,.07)!important">
    <h6 class="fw-semibold text-white mb-0">{{ $group }}</h6>
  </div>
  <div class="table-responsive">
    <table class="table table-dark table-hover mb-0">
      <thead><tr>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Label</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">URL</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Order</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @foreach($groupLinks as $link)
        <tr>
          <td class="text-white" style="font-size:.85rem">{{ $link->label }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45);font-family:monospace">{{ $link->url }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45)">{{ $link->sort_order }}</td>
          <td><span class="badge" style="{{ $link->is_active ? 'background:rgba(74,222,128,.15);color:#4ade80' : 'background:rgba(255,255,255,.06);color:rgba(255,255,255,.4)' }};font-size:.72rem">{{ $link->is_active ? 'Active' : 'Inactive' }}</span></td>
          <td class="text-end">
            <a href="{{ route('admin.footer-links.edit', $link) }}" class="btn btn-sm btn-outline-secondary me-1" style="font-size:.75rem">Edit</a>
            <form method="POST" action="{{ route('admin.footer-links.destroy', $link) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" style="font-size:.75rem">Delete</button>
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
