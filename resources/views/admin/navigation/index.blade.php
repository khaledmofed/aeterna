@extends('layouts.admin')
@section('title','Navigation')
@section('breadcrumb')<li class="breadcrumb-item active">Navigation</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Navigation</h1>
  <a href="{{ route('admin.navigation.create') }}" class="btn btn-accent btn-sm px-3">+ Add Item</a>
</div>

<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table table-dark table-hover mb-0">
      <thead><tr>
        <th class="fw-medium text-white-50" style="font-size:.8rem">Label</th>
        <th class="fw-medium text-white-50" style="font-size:.8rem">URL</th>
        <th class="fw-medium text-white-50" style="font-size:.8rem">Parent</th>
        <th class="fw-medium text-white-50" style="font-size:.8rem">Order</th>
        <th class="fw-medium text-white-50" style="font-size:.8rem">Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @forelse($navItems as $item)
        <tr>
          <td class="text-white" style="font-size:.85rem">{{ $item->label }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45);font-family:monospace">{{ $item->url }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45)">{{ $item->parent?->label ?? '—' }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45)">{{ $item->sort_order }}</td>
          <td>
            <span class="badge" style="{{ $item->is_active ? 'background:rgba(74,222,128,.15);color:#4ade80' : 'background:rgba(255,255,255,.06);color:rgba(255,255,255,.4)' }};font-size:.72rem">
              {{ $item->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.navigation.edit', $item) }}" class="btn btn-sm btn-outline-secondary me-1" style="font-size:.75rem">Edit</a>
            <form method="POST" action="{{ route('admin.navigation.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" style="font-size:.75rem">Delete</button>
            </form>
          </td>
        </tr>
        @foreach($item->children as $child)
        <tr style="background:rgba(255,255,255,.02)">
          <td class="ps-4 text-white-50" style="font-size:.83rem">↳ {{ $child->label }}</td>
          <td style="font-size:.8rem;color:rgba(255,255,255,.35);font-family:monospace">{{ $child->url }}</td>
          <td style="font-size:.8rem;color:rgba(255,255,255,.35)">{{ $item->label }}</td>
          <td style="font-size:.8rem;color:rgba(255,255,255,.35)">{{ $child->sort_order }}</td>
          <td><span class="badge" style="background:rgba(74,222,128,.1);color:#4ade80;font-size:.7rem">{{ $child->is_active ? 'Active' : 'Inactive' }}</span></td>
          <td class="text-end">
            <a href="{{ route('admin.navigation.edit', $child) }}" class="btn btn-sm btn-outline-secondary me-1" style="font-size:.72rem">Edit</a>
            <form method="POST" action="{{ route('admin.navigation.destroy', $child) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" style="font-size:.72rem">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
        @empty
        <tr><td colspan="6" class="text-center py-4" style="color:rgba(255,255,255,.3)">No nav items</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
