@extends('layouts.admin')

@section('title', 'Security Logs')

@section('content')
<div class="container">
    <h1 class="mb-4">Security Logs</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($logs as $log)
        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->description }}</td>
            <td>{{ ucfirst($log->status) }}</td>
            <td>
                @if ($log->status !== 'resolved')
                <form action="{{ route('admin.security.resolve', $log->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Resolve</button>
                </form>
                @else
                <span class="text-muted">Resolved</span>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
