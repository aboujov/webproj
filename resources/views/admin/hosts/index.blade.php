@extends('layouts.admin')

@section('content')
    <h1>Host Verification</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hosts as $host)
                <tr>
                    <td>{{ $host->id }}</td>
                    <td>{{ $host->name }}</td>
                    <td>{{ $host->email }}</td>
                    <td>{{ $host->verification_status }}</td>
                    <td>
                        @if($host->verification_status === 'pending')
                            <form method="POST" action="{{ route('admin.hosts.verify', $host->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit">Verify</button>
                            </form>
                            <form method="POST" action="{{ route('admin.hosts.reject', $host->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit">Reject</button>
                            </form>
                        @else
                            {{ ucfirst($host->verification_status) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection