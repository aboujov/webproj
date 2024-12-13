@extends('layouts.admin')

@section('content')
    <h1>Transactions</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
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
                    <td>{{ ucfirst($transaction->status) }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.transactions.update', $transaction->id) }}">
                            @csrf
                            <select name="status">
                                <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="refunded" {{ $transaction->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                <option value="disputed" {{ $transaction->status === 'disputed' ? 'selected' : '' }}>Disputed</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <section>
        <a href="{{ route('admin.transactions.report') }}">Download Financial Report</a>
    </section>
@endsection
