@extends('layouts.admin')

@section('content')
    <h1>Activity Logs</h1>

    <pre style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
        @foreach ($logs as $log)
            {{ $log }}
        @endforeach
    </pre>
@endsection
