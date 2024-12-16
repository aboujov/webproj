<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecurityLog;

class SecurityController extends Controller
{
    public function index()
    {
        $logs = SecurityLog::latest()->get();
        return view('admin.security.index', compact('logs'));
    }

    public function resolve(Request $request, $id)
    {
        $log = SecurityLog::findOrFail($id);
        $log->update(['status' => 'resolved']);
        return redirect()->route('admin.security')->with('success', 'Log resolved successfully.');
    }
}
