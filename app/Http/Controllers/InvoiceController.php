<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('booking.pet.owner')->latest()->paginate(20);
        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('booking.pet.owner');
        return view('invoices.show', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'paid' => 'required|boolean',
            'payment_method' => 'nullable|string',
        ]);

        $invoice->update(array_merge($data, ['paid_at' => $data['paid'] ? now() : null]));
        
        // Notify admins about payment
        if ($data['paid']) {
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                \App\Models\Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'payment_received',
                    'title' => 'Payment Received',
                    'message' => 'Payment received for Invoice #INV-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT),
                    'data' => json_encode([
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->amount,
                    ]),
                ]);
            }

            // Notify customer about payment confirmation
            $customerUser = \App\Models\User::where('email', $invoice->booking->pet->owner->email)->first();
            if ($customerUser) {
                \App\Models\Notification::create([
                    'user_id' => $customerUser->id,
                    'type' => 'payment_received',
                    'title' => 'messages.notifications.payment_confirmed.title',
                    'message' => 'messages.notifications.payment_confirmed.message',

                    'data' => json_encode([
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->amount,
                    ]),
                ]);
            }
        }
        
        return redirect()->route('invoices.show', $invoice)->with('success', __('messages.invoice_updated'));

    }
}
