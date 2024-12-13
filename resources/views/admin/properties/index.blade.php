@extends('layouts.admin')

@section('content')
    <h1>Property Management</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Host</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->title }}</td>
                    <td>{{ $property->description }}</td>
                    <td>{{ $property->host->name }}</td>
                    <td>{{ $property->status }}</td>
                    <td>
                        @if($property->status === 'pending')
                            <form method="POST" action="{{ route('admin.properties.approve', $property->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.properties.reject', $property->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
