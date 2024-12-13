@extends('layouts.admin') <!-- Extends the admin layout -->

@section('content')
    <h1>Edit Announcement</h1>

    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $announcement->title) }}" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control" rows="5" required>{{ old('message', $announcement->message) }}</textarea>
        </div>

        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" class="form-control" required>
                <option value="1" {{ $announcement->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$announcement->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Announcement</button>
        <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
