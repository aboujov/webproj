<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
{
    $properties = Property::all(); // Fetch all properties
    return view('admin.properties.index', compact('properties'));
}

public function approve($id)
{
    $property = Property::findOrFail($id);
    $property->update(['status' => 'approved']);
    return redirect()->route('admin.properties')->with('success', 'Property approved successfully!');
}

public function reject($id)
{
    $property = Property::findOrFail($id);
    $property->update(['status' => 'rejected']);
    return redirect()->route('admin.properties')->with('success', 'Property rejected successfully!');
}

}
