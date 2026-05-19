@extends('layouts.admin')
@section('title','Use Cases')
@section('breadcrumb')<li class="breadcrumb-item active">Use Cases</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Use Cases</h1>
  <a href="{{ route('admin.use-cases.create') }}" class="btn btn-accent btn-sm px-4">+ Add Use Case</a>
</div>
<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead><tr>
        <th>Title</th>
        <th>Category</th>
        <th>Order</th>
        <th>Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @forelse($useCases as $uc)
        <tr>
          <td>{{ $uc->title }}</td>
          <td class="text-muted-cell">{{ $uc->category ?? '—' }}</td>
          <td class="text-muted-cell">{{ $uc->sort_order }}</td>
          <td>
            <span class="wise-badge {{ $uc->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}">
              {{ $uc->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.use-cases.edit', $uc) }}" class="btn btn-wise-outline btn-sm me-1">Edit</a>
            <form method="POST" action="{{ route('admin.use-cases.destroy', $uc) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-wise-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-4" style="color:var(--wise-mute)">No use cases added yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
