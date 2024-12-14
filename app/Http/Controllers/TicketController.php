<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
{
    $tickets = Ticket::with('user')->get();
    return view('admin.tickets.index', compact('tickets'));
}

public function updateStatus(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);
    $ticket->update(['status' => $request->status]);
    return redirect()->route('admin.tickets')->with('success', 'Ticket status updated successfully!');
}

public function getUnresolvedTicketsCount()
{
    $ticket = Ticket::where('status', '!=', 'resolved')->count();
    return response()->json(['count' => $ticket]);
}
}
