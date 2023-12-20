<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ItineraryGenerationController extends Controller
{
    public function index()
    {
        return view('itinerary_form');
    }

    public function generate(Request $request)
    {
        $country = $request->input('country');

        $request->validate([
            'days' => 'nullable|integer|max:14|min:1',

        ], [
            'days.max' => 'We are sorry, currently our itinerary only supports a maximum of 14 days.',
            'days.min' => 'Too rush for your trip.',

        ]);

        $days = $request->input('days');

        try {

            $response = Http::get("http://127.0.0.1:5000/generate_itinerary/{$country}?days={$days}");
    
            // Check if the request was successful (status code 2xx)
            if ($response->successful()) {
                // Parse the JSON response
                $itinerary = $response->json();
    
                $recommendedHotels=$itinerary[1];
                // Pass the itinerary to the view
                return view('itinerary', ['itinerary' => $itinerary[0], 'recommendedHotels' => $recommendedHotels,'itinerary_status' => $itinerary[2]]);
            } else {
                $error = $response->json()['error'] ?? 'Failed to fetch itinerary. Please try again.';
                return redirect()->back()->with('error', $error);
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }
}
