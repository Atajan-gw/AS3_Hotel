<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelAdminController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('city')->latest()->get();

        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $cities = City::all();

        return view('admin.hotels.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'city_id' => ['required', 'exists:cities,id', 'integer'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255', 'unique:hotels,slug'],
            'description' => ['nullable', 'string', 'max:2000'],
            'address' => ['required', 'string', 'min:5', 'max:255'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        Hotel::create($data);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function edit(Hotel $hotel)
    {
        $cities = City::all();

        return view('admin.hotels.edit', compact('hotel', 'cities'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'city_id' => ['required', 'exists:cities,id', 'integer'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255', 'unique:hotels,slug,' . $hotel->id],
            'description' => ['nullable', 'string', 'max:2000'],
            'address' => ['required', 'string', 'min:5', 'max:255'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $hotel->update($data);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function show(Hotel $hotel)
    {
        $hotel->load(['city', 'rooms']);

        return view('admin.hotels.show', compact('hotel'));
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }
}
