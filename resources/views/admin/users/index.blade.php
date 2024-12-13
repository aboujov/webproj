@extends('layouts.admin')

@section('content')
    <h1>User Management</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    
                        
                        <td>{{ $user->status }}</td>
<td>
    @if($user->status === 'pending')
        <form method="POST" action="{{ route('admin.users.approve', $user->id) }}" style="display: inline;">
            @csrf
            <button type="submit">Approve</button>
        </form>
    @endif
    @if($user->status !== 'banned')
        <form method="POST" action="{{ route('admin.users.ban', $user->id) }}" style="display: inline;">
            @csrf
            <button type="submit">Ban</button>
        </form>
    @endif
</td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
