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
        // Validate the request
        $announcement = Announcement::create($request->all());

        // Send email to all users for the new announcement
        $users = User::all();
        foreach ($users as $user) {
            // Send a 'created' type announcement email
            Mail::to($user->email)->send(new AnnouncementMail($announcement, 'created'));
        }

        return redirect()->route('admin.announcements.index');
    }


    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        // Update the announcement with the new data
        $announcement->update($request->all());

        // Send email to all users about the updated announcement
        $users = User::all();
        foreach ($users as $user) {
            // Send an 'edited' type announcement email
            Mail::to($user->email)->send(new AnnouncementMail($announcement, 'edited'));
        }

        return redirect()->route('admin.announcements.index');
    }

    public function destroy(Announcement $announcement)
    {
        // Send email to all users about the deleted announcement before actually deleting it
        $users = User::all();
        foreach ($users as $user) {
            // Send a 'deleted' type announcement email
            Mail::to($user->email)->send(new AnnouncementMail($announcement, 'deleted'));
        }

        // Delete the announcement
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted and users notified.');
    }
}

