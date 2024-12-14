@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Ticket Management</h1>

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
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ $ticket->message }}</td>
                                <td>
                                    <span class="fw-bold 
                                        {{ $ticket->status === 'open' ? 'text-primary' : '' }}
                                        {{ $ticket->status === 'in_progress' ? 'text-warning' : '' }}
                                        {{ $ticket->status === 'resolved' ? 'text-success' : '' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}" class="d-inline">
                                        @csrf
                                        <div class="d-flex gap-2">
                                            <select name="status" class="form-select form-select-sm">
                                                <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="bi bi-save"></i> Update
                                            </button>
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
</div>
@endsection
