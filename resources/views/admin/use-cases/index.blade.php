@extends('layouts.admin')
@section('title','Use Cases')
@section('breadcrumb')<li class="breadcrumb-item active">Use Cases</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Use Cases</h1>
  <a href="{{ route('admin.use-cases.create') }}" class="btn btn-accent btn-sm px-3">+ Add Use Case</a>
</div>
<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table table-dark table-hover mb-0">
      <thead><tr>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Title</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Category</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Order</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @forelse($useCases as $uc)
        <tr>
          <td class="text-white" style="font-size:.85rem">{{ $uc->title }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45)">{{ $uc->category ?? '—' }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45)">{{ $uc->sort_order }}</td>
          <td><span class="badge" style="{{ $uc->is_active ? 'background:rgba(74,222,128,.15);color:#4ade80' : 'background:rgba(255,255,255,.06);color:rgba(255,255,255,.4)' }};font-size:.72rem">{{ $uc->is_active ? 'Active' : 'Inactive' }}</span></td>
          <td class="text-end">
            <a href="{{ route('admin.use-cases.edit', $uc) }}" class="btn btn-sm btn-outline-secondary me-1" style="font-size:.75rem">Edit</a>
            <form method="POST" action="{{ route('admin.use-cases.destroy', $uc) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" style="font-size:.75rem">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-4" style="color:rgba(255,255,255,.3)">No use cases</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
