@extends('layouts.admin')
@section('title','Subscribers')
@section('breadcrumb')<li class="breadcrumb-item active">Subscribers</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="admin-section-title">
    Subscribers
    <span class="wise-badge wise-badge-stage ms-2" style="font-size:.75rem;vertical-align:middle">{{ $subscribers->total() }}</span>
  </h1>
  <a href="{{ route('admin.subscribers.export') }}" class="btn btn-wise-secondary btn-sm px-4">
    <i class="bi bi-download me-1"></i>Export CSV
  </a>
</div>
<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table wise-table mb-0">
      <thead><tr>
        <th>#</th>
        <th>Email</th>
        <th>Subscribed</th>
        <th>Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @forelse($subscribers as $sub)
        <tr>
          <td class="text-muted-cell">{{ $sub->id }}</td>
          <td>{{ $sub->email }}</td>
          <td class="text-muted-cell">{{ $sub->subscribed_at?->format('M d, Y H:i') }}</td>
          <td><span class="wise-badge wise-badge-active">Active</span></td>
          <td class="text-end">
            <form method="POST" action="{{ route('admin.subscribers.destroy', $sub) }}" class="d-inline" onsubmit="return confirm('Remove subscriber?')">
              @csrf @method('DELETE')
              <button class="btn btn-wise-danger btn-sm">Remove</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-4" style="color:var(--wise-mute)">No subscribers yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($subscribers->hasPages())
  <div class="p-3" style="border-top:1px solid var(--wise-canvas-soft)">
    {{ $subscribers->links() }}
  </div>
  @endif
</div>
@endsection
