<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
{
    $transactions = Transaction::with('booking', 'user')->get();
    return view('admin.transactions.index', compact('transactions'));
}

public function updateStatus(Request $request, $id)
{
    $transaction = Transaction::findOrFail($id);
    $transaction->update(['status' => $request->status]);
    return redirect()->route('admin.transactions')->with('success', 'Transaction status updated successfully!');
}

public function generateReport()
{
    $transactions = Transaction::all();
    $filename = 'financial_report_' . now()->format('Y-m-d') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=$filename",
    ];

    $callback = function () use ($transactions) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['Transaction ID', 'User', 'Type', 'Amount', 'Status', 'Created At']);

        foreach ($transactions as $transaction) {
            fputcsv($file, [
                $transaction->id,
                $transaction->user->name,
                $transaction->type,
                $transaction->amount,
                $transaction->status,
                $transaction->created_at,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function getTotalAmount()
{
    $totalAmount = Transaction::sum('amount');
    return response()->json(['total_amount' => $totalAmount], 200);
}


public function getLastTransactions()
{
    $transactions = Transaction::with('booking', 'user')
        ->latest()
        ->take(4)
        ->get();

    return response()->json($transactions);
}

}
