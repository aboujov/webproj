<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Mail\AnnouncementMail;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $announcement = Announcement::create($request->all());

    // Send email to all users
    $users = User::all();
    foreach ($users as $user) {
       Mail::to($user->email)->send(new AnnouncementMail($announcement));
    }

    return redirect()->route('admin.announcements.index');
}

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $announcement->update($request->all());
        return redirect()->route('admin.announcements.index');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index');
    }
}

