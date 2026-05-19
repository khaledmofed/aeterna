@extends('layouts.admin')
@section('title','Investors')
@section('breadcrumb')<li class="breadcrumb-item active">Investors</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">Investors</h1>
  <a href="{{ route('admin.investors.create') }}" class="btn btn-accent btn-sm px-4">+ Add Investor</a>
</div>
<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead><tr>
        <th>Name</th>
        <th>Type</th>
        <th>Order</th>
        <th>Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @forelse($investors as $inv)
        <tr>
          <td>
            @if($inv->logo_url)<img src="{{ $inv->logo_url }}" alt="{{ $inv->name }}" style="height:18px;margin-right:.5rem;opacity:.8" onerror="this.style.display='none'">@endif
            {{ $inv->name }}
          </td>
          <td><span class="wise-badge wise-badge-type">{{ ucfirst($inv->type) }}</span></td>
          <td class="text-muted-cell">{{ $inv->sort_order }}</td>
          <td>
            <span class="wise-badge {{ $inv->is_active ? 'wise-badge-active' : 'wise-badge-inactive' }}">
              {{ $inv->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.investors.edit', $inv) }}" class="btn btn-wise-outline btn-sm me-1">Edit</a>
            <form method="POST" action="{{ route('admin.investors.destroy', $inv) }}" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-wise-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-4" style="color:var(--wise-mute)">No investors added yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
