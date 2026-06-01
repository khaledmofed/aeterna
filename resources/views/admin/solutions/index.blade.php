@extends('layouts.admin')
@section('title','Solutions')
@section('breadcrumb')<li class="breadcrumb-item active">Solutions</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Solutions</h1>
  <a href="{{ route('admin.solutions.create') }}" class="btn btn-accent btn-sm px-4">+ Add Row</a>
</div>

@if(session('success'))
  <div class="alert alert-success rounded-3 mb-4">{{ session('success') }}</div>
@endif

<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead><tr>
        <th style="width:32px"></th>
        <th>Challenge</th>
        <th>Current State</th>
        <th>Aeterna Solution</th>
        <th>Status</th>
        <th></th>
      </tr></thead>
      <tbody id="solutions-tbody">
        @forelse($solutions as $s)
        <tr data-id="{{ $s->id }}" style="cursor:grab">
          <td><span style="color:#aaa;font-size:18px">≡</span></td>
          <td class="fw-semibold">{{ $s->challenge }}</td>
          <td class="text-muted-cell" style="max-width:220px">{{ $s->current_state }}</td>
          <td style="max-width:220px">{{ $s->aeterna_solution }}</td>
          <td>
            <span class="wise-badge {{ $s->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}">
              {{ $s->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.solutions.edit', $s) }}" class="btn btn-wise-outline btn-sm me-1">Edit</a>
            <form method="POST" action="{{ route('admin.solutions.destroy', $s) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-wise-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4" style="color:var(--wise-mute)">No rows yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
Sortable.create(document.getElementById('solutions-tbody'), {
  animation: 150,
  ghostClass: 'table-active',
  onEnd() {
    const order = [...document.querySelectorAll('#solutions-tbody tr[data-id]')].map(r => r.dataset.id);
    fetch('{{ route('admin.solutions.reorder') }}', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
      body: JSON.stringify({ order }),
    });
  }
});
</script>
@endsection
