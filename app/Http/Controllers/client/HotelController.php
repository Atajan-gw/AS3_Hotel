<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::with('city');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('min_rating')) {
            $query->where('rating', '>=', $request->min_rating);
        }

        if ($request->get('sort') === 'rating_desc') {
            $query->orderByDesc('rating');
        }

        if ($request->get('sort') === 'rating_asc') {
            $query->orderBy('rating');
        }

        $hotels = $query->paginate(30)->withQueryString();

        return view('client.hotels.index', compact('hotels'));
    }

    public function show(Hotel $hotel)
    {
        return view('client.hotels.show', compact('hotel'));
    }

    public function locale($locale)
    {
        $locale = in_array($locale, ['en', 'tm', 'ru']) ? $locale : 'en';
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
