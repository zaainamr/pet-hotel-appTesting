<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rooms = $query->paginate(15);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:rooms,code',
            'type' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'rate_per_day' => 'required|numeric|min:10000',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/rooms', 'public');
            $data['image'] = $path;
        }

        $data['status'] = 'available';

        Room::create($data);
        return redirect()->route('rooms.index')->with('success', __('messages.room_created'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        if (in_array($room->status, ['occupied', 'penuh'])) {
            return redirect()->route('rooms.index')->with('error', __('messages.room_edit_has_booking'));
        }
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:rooms,code,' . $room->id,
            'type' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'rate_per_day' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance,penuh',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($room->image && $room->image != 'images/default-room.png') {
                Storage::disk('public')->delete($room->image);
            }
            $path = $request->file('image')->store('images/rooms', 'public');
            $data['image'] = $path;
        }

        $room->update($data);
        return redirect()->route('rooms.index')->with('success', __('messages.room_updated'));
    }

    public function destroy(Room $room)
    {
        if (in_array($room->status, ['occupied', 'penuh'])) {
            return redirect()->route('rooms.index')->with('error', __('messages.room_delete_has_booking'));
        }

        $room->delete();
        return redirect()->route('rooms.index')->with('success', __('messages.room_deleted'));
    }
}
