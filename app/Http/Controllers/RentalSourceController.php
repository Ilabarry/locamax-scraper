<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalSource;

class RentalSourceController extends Controller
{
    public function index(Request $request)
    {
        // Filtrage par ville
        $selectedCity = $request->get('city');

        $query = RentalSource::query();

        if (!empty($selectedCity)) {
            $query->where('city', $selectedCity);
        }

        $rentals = $query->orderBy('id', 'desc')->get();

        // Récupération de toutes les villes distinctes
        $cities = RentalSource::select('city')
                    ->distinct()
                    ->orderBy('city')
                    ->pluck('city');

        return view('rentals.index', compact('rentals', 'cities', 'selectedCity'));
    }
}
