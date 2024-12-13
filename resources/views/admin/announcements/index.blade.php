@extends('layouts.admin') <!-- Extends the admin layout -->

@section('content')
    <h1>Announcements</h1>

    <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary mb-3">Create New Announcement</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ Str::limit($announcement->message, 50) }}</td>
                    <td>{{ $announcement->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
