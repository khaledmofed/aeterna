@extends('layouts.admin')
@section('title','Navigation')
@section('breadcrumb')<li class="breadcrumb-item active">Navigation</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Navigation</h1>
  <a href="{{ route('admin.navigation.create') }}" class="btn btn-accent btn-sm px-4">+ Add Item</a>
</div>

<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead><tr>
        <th>Label</th>
        <th>URL</th>
        <th>Parent</th>
        <th>Order</th>
        <th>Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @forelse($navItems as $item)
        <tr>
          <td>{{ $item->label }}</td>
          <td class="text-muted-cell" style="font-family:monospace;font-size:.8rem">{{ $item->url }}</td>
          <td class="text-muted-cell">{{ $item->parent?->label ?? '—' }}</td>
          <td class="text-muted-cell">{{ $item->sort_order }}</td>
          <td>
            <span class="wise-badge {{ $item->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}">
              {{ $item->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.navigation.edit', $item) }}" class="btn btn-wise-outline btn-sm me-1">Edit</a>
            <form method="POST" action="{{ route('admin.navigation.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-wise-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @foreach($item->children as $child)
        <tr style="background:#fafbfa">
          <td class="ps-4 text-muted-cell" style="font-size:.83rem">↳ {{ $child->label }}</td>
          <td class="text-muted-cell" style="font-family:monospace;font-size:.78rem">{{ $child->url }}</td>
          <td class="text-muted-cell" style="font-size:.8rem">{{ $item->label }}</td>
          <td class="text-muted-cell" style="font-size:.8rem">{{ $child->sort_order }}</td>
          <td>
            <span class="wise-badge {{ $child->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}" style="font-size:.7rem">
              {{ $child->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.navigation.edit', $child) }}" class="btn btn-wise-outline btn-sm me-1">Edit</a>
            <form method="POST" action="{{ route('admin.navigation.destroy', $child) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-wise-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
        @empty
        <tr><td colspan="6" class="text-center py-4" style="color:var(--wise-mute)">No nav items added yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
