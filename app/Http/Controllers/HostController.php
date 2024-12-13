<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function index()
{
    $hosts = User::where('role', 'host')->get(); // Assuming "role" column differentiates user types
    return view('admin.hosts.index', compact('hosts'));
}

public function verify($id)
{
    $host = User::findOrFail($id);
    $host->update(['verification_status' => 'verified']);
    return redirect()->route('admin.hosts')->with('success', 'Host verified successfully!');
}

public function reject($id)
{
    $host = User::findOrFail($id);
    $host->update(['verification_status' => 'rejected']);
    return redirect()->route('admin.hosts')->with('success', 'Host rejected successfully!');
}

}
