@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Property Management</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
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
                        <td>
                            <span class="fw-bold
                                {{ $property->status === 'approved' ? 'text-success' : '' }}
                                {{ $property->status === 'pending' ? 'text-warning' : '' }}
                                {{ $property->status === 'rejected' ? 'text-danger' : '' }}">
                                {{ ucfirst($property->status) }}
                            </span>
                        </td>
                        <td class="d-flex justify-content-between">
                            @if($property->status === 'pending')
                                <form method="POST" action="{{ route('admin.properties.approve', $property->id) }}" class="d-flex justify-content-between">
                                    @csrf
                                    <button type="submit" class="btn btn-success mr-2"><i class="bi bi-check"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.properties.reject', $property->id) }}" class="d-flex justify-content-between">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-x"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection