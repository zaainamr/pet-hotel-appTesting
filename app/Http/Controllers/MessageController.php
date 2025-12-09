<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Customer: View messages
    public function customerIndex()
    {
        $user = Auth::user();
        
        // Get all admins
        $admins = User::where('role', 'admin')->get();
        
        // Get messages between customer and any admin
        $messages = Message::where(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
        })->with(['sender', 'receiver'])
          ->orderBy('created_at', 'asc')
          ->get();

        // Mark messages from admin as read
        Message::where('receiver_id', $user->id)
            ->whereIn('sender_id', $admins->pluck('id'))
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('customer.messages', compact('messages', 'admins'));
    }

    // Customer: Send message to admin
    public function customerStore(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'nullable|exists:users,id',
        ]);

        $user = Auth::user();
        
        // If no receiver specified, send to first admin
        $receiverId = $data['receiver_id'] ?? User::where('role', 'admin')->first()->id;

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'message' => $data['message'],
        ]);

        // Notify admin about new message
        \App\Models\Notification::create([
            'user_id' => $receiverId,
            'type' => 'new_message',
            'title' => 'New Message',
            'message' => $user->name . ' sent you a message',
            'data' => json_encode([
                'message_id' => $message->id,
                'sender_name' => $user->name,
            ]),
        ]);

        return redirect()->route('customer.messages.index')->with('success', __('messages.message_sent'));
    }

    // Admin: View all conversations
    public function adminIndex()
    {
        $user = Auth::user();
        
        // Get all customers who have sent messages
        $customers = User::where('role', 'customer')
            ->whereHas('sentMessages', function($query) use ($user) {
                $query->where('receiver_id', $user->id);
            })
            ->orWhereHas('receivedMessages', function($query) use ($user) {
                $query->where('sender_id', $user->id);
            })
            ->with(['sentMessages' => function($query) use ($user) {
                $query->where('receiver_id', $user->id)
                      ->orWhere('sender_id', $user->id);
            }])
            ->get();

        return view('admin.messages.index', compact('customers'));
    }

    // Admin: View conversation with specific customer
    public function adminShow(User $customer)
    {
        $user = Auth::user();
        
        $messages = Message::conversation($user->id, $customer->id)
            ->with(['sender', 'receiver'])
            ->get();

        // Mark messages as read
        Message::where('sender_id', $customer->id)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('admin.messages.show', compact('customer', 'messages'));
    }

    // Admin: Send message to customer
    public function adminStore(Request $request, User $customer)
    {
        $data = $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $customer->id,
            'message' => $data['message'],
        ]);

        // Notify customer about new message
        \App\Models\Notification::create([
            'user_id' => $customer->id,
            'type' => 'new_message',
            'title' => 'messages.notifications.new_message_from_admin.title',
            'message' => 'messages.notifications.new_message_from_admin.message',
            'data' => json_encode([
                'message_id' => $message->id,
                'sender_name' => $user->name,
            ]),
        ]);

        return redirect()->route('messages.show', $customer)->with('success', __('messages.message_sent'));
    }

    // API: Get unread message count
    public function unreadCount()
    {
        $user = Auth::user();
        
        $count = Message::where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }
}
