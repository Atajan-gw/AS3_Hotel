<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Hotel $hotel)
    {
        $rooms = $hotel->rooms()->where('is_available', true)->get();

        return view('client.reservations.create', compact('hotel', 'rooms'));
    }

    public function store(Request $request, Hotel $hotel)
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
            'special_requests' => ['nullable', 'string'],
        ]);

        $room = Room::findOrFail($data['room_id']);

        if ($room->hotel_id !== $hotel->id) {
            abort(403);
        }

        $guest = Guest::updateOrCreate(
            ['email' => $data['email']],
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
            ]
        );

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
            'status' => 'confirmed',
            'special_requests' => $data['special_requests'] ?? null,
        ]);

        $room->update(['is_available' => false]);

        return redirect()->route('hotels.show', $hotel)->with('success', 'Reservation created successfully.');
    }
}
