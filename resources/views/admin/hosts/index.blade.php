@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Host Verification</h1>

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
                                <td>
                                    <span class="fw-bold 
                                        {{ $host->verification_status === 'verified' ? 'text-success' : '' }}
                                        {{ $host->verification_status === 'pending' ? 'text-warning' : '' }}
                                        {{ $host->verification_status === 'rejected' ? 'text-danger' : '' }}">
                                        {{ ucfirst($host->verification_status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($host->verification_status === 'pending')
                                        <div class="d-flex gap-2">
                                            <form method="POST" action="{{ route('admin.hosts.verify', $host->id) }}" class="mr-2">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.hosts.reject', $host->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        {{ ucfirst($host->verification_status) }}
                                    @endif
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