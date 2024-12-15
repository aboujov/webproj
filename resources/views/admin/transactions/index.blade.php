@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Transactions</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ ucfirst($transaction->type) }}</td>
                                <td>${{ number_format($transaction->amount, 2) }}</td>
                                <td>
                                    <span class="fw-bold 
                                        {{ $transaction->status === 'completed' ? 'text-success' : '' }}
                                        {{ $transaction->status === 'pending' ? 'text-warning' : '' }}
                                        {{ $transaction->status === 'refunded' ? 'text-danger' : '' }}
                                        {{ $transaction->status === 'disputed' ? 'text-secondary' : '' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.transactions.update', $transaction->id) }}" class="d-inline">
                                        @csrf
                                        <div class="d-flex gap-2">
                                            <select name="status" class="form-select form-select-sm">
                                                <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="refunded" {{ $transaction->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                                <option value="disputed" {{ $transaction->status === 'disputed' ? 'selected' : '' }}>Disputed</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.transactions.report') }}" class="btn btn-secondary">
            <i class="bi bi-download"></i> Download Financial Report
        </a>
    </div>
</div>
@endsection
