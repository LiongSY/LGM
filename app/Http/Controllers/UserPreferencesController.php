<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;
class UserPreferencesController extends Controller
{
    public function create()
    {
        return view('userPreferences');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'preferredSeason' => 'required|string',
            'activityLevel' => 'required|string',
            'accomodationStyle' => 'required|string',
            'destination' => 'required|string',
            'travelGroup' => 'required|string',
        ]);

        UserPreference::create([
            'userID' => auth()->user()->userID,
            'season' => $validatedData['preferredSeason'],
            'activity' => $validatedData['activityLevel'],
            'accomodation' => $validatedData['accomodationStyle'],
            'destination' => $validatedData['destination'],
            'travelGroup' => $validatedData['travelGroup'],
        ]);

        return redirect()->route('homePage')->with('success', 'Preferences saved successfully!');
    }
}
