<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    return view('admin.dashboard');
}

public function logs()
{
    $logs = file(storage_path('logs/laravel.log'));
    return view('admin.logs', compact('logs'));
}

}
