<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\City;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
            'min_rating' => ['nullable', 'numeric', 'between:0,5'],
            'sort' => ['nullable', 'string', 'in:rating_desc,rating_asc'],
        ]);

        $query = Hotel::with('city');

        if (!empty($data['search'])) {
            $search = trim($data['search']);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('address', 'like', "%{$search}%");
            });
        }

        if (!empty($data['city_id'])) {
            $query->where('city_id', $data['city_id']);
        }

        if (!empty($data['min_rating'])) {
            $query->where('rating', '>=', $data['min_rating']);
        }

        if ($data['sort'] ?? null === 'rating_desc') {
            $query->orderByDesc('rating');
        }

        if ($data['sort'] ?? null === 'rating_asc') {
            $query->orderBy('rating');
        }

        $hotels = $query->paginate(30)->withQueryString();
        $cities = City::all();

        return view('client.hotels.index', compact('hotels', 'cities'));
    }

    public function show(Hotel $hotel)
    {
        return view('client.hotels.show', compact('hotel'));
    }

    public function locale(Request $request, $locale)
    {
        $locale = $request->validate([
            'locale' => ['nullable', 'string', 'in:en,tm,ru'],
        ])['locale'] ?? $locale;

        $locale = in_array($locale, ['en', 'tm', 'ru'], true) ? $locale : 'en';
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
