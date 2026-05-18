@extends('layouts.admin')
@section('title','Subscribers')
@section('breadcrumb')<li class="breadcrumb-item active">Subscribers</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold text-white mb-0">Subscribers <span class="badge badge-accent ms-2" style="font-size:.75rem">{{ $subscribers->total() }}</span></h1>
  <a href="{{ route('admin.subscribers.export') }}" class="btn btn-outline-secondary btn-sm px-3">
    <i class="bi bi-download me-1"></i>Export CSV
  </a>
</div>
<div class="admin-card p-0">
  <div class="table-responsive">
    <table class="table table-dark table-hover mb-0">
      <thead><tr>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">#</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Email</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Subscribed</th>
        <th class="text-white-50 fw-medium" style="font-size:.8rem">Status</th>
        <th></th>
      </tr></thead>
      <tbody>
        @forelse($subscribers as $sub)
        <tr>
          <td style="font-size:.82rem;color:rgba(255,255,255,.4)">{{ $sub->id }}</td>
          <td class="text-white" style="font-size:.85rem">{{ $sub->email }}</td>
          <td style="font-size:.82rem;color:rgba(255,255,255,.45)">{{ $sub->subscribed_at?->format('M d, Y H:i') }}</td>
          <td><span class="badge" style="background:rgba(74,222,128,.15);color:#4ade80;font-size:.72rem">Active</span></td>
          <td class="text-end">
            <form method="POST" action="{{ route('admin.subscribers.destroy', $sub) }}" class="d-inline" onsubmit="return confirm('Remove subscriber?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" style="font-size:.75rem">Remove</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-4" style="color:rgba(255,255,255,.3)">No subscribers yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($subscribers->hasPages())
  <div class="p-3 border-top" style="border-color:rgba(255,255,255,.07)!important">
    {{ $subscribers->links() }}
  </div>
  @endif
</div>
@endsection
