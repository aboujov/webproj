@extends('layouts.admin') <!-- Extends the admin layout -->

@section('content')
    <h1>Create Announcement</h1>

    <form action="{{ route('admin.announcements.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
        </div>

        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" class="form-control" required>
                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Announcement</button>
        <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
