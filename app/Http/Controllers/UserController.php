<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('admin.users.index', compact('users'));
    }

    public function approve($id)
{
    $user = User::findOrFail($id);
    $user->update(['status' => 'approved']); // Update status
    return redirect()->route('admin.users')->with('success', 'User approved successfully!');
}


public function ban($id)
{
    $user = User::findOrFail($id);
    $user->update(['status' => 'banned']); // Update status
    return redirect()->route('admin.users')->with('success', 'User banned successfully!');
}

}
