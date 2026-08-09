<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['room.hotel', 'guest'])->latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::with('hotel')->get();

        return view('admin.bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => ['required', 'exists:rooms,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:255'],
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date', 'after_or_equal:check_in'],
            'guests_count' => ['required', 'integer', 'min:1', 'max:10'],
            'status' => ['required', 'string'],
            'special_requests' => ['nullable', 'string'],
        ]);

        $guest = Guest::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        $room = Room::findOrFail($data['room_id']);
        $nights = now()->parse($data['check_in'])->diffInDays(now()->parse($data['check_out']));
        $totalPrice = $room->price_per_night * max($nights, 1);

        Booking::create([
            'room_id' => $room->id,
            'guest_id' => $guest->id,
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'guests_count' => $data['guests_count'],
            'price_per_night' => $room->price_per_night,
            'total_price' => $totalPrice,
            'status' => $data['status'],
            'special_requests' => $data['special_requests'] ?? null,
        ]);

        $room->update(['is_available' => false]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
