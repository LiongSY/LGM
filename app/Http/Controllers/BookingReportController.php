<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingReportController extends Controller
{
    public function generateReport(Request $request)
    {
        // Your existing code to get bookings
        $selectedMonth = $request->input('selectedMonth', now()->format('Y-m'));
        $startDate = Carbon::parse($selectedMonth)->startOfMonth();
        $endDate = Carbon::parse($selectedMonth)->endOfMonth();
        $bookings = Booking::whereBetween('bookingDate', [$startDate, $endDate])
            ->where('bookingStatus', 'Completed')
            ->get();

        // Calculate total amount
        $totalAmount = $bookings->sum('bookingAmount');

                // Get the top 3 tours based on bookings count
        $top3Tours = DB::table('tours')
        ->join('bookings', 'tours.tourCode', '=', 'bookings.tourCode')
        ->whereBetween('bookings.bookingDate', [$startDate, $endDate])
        ->select('tours.*', DB::raw('COUNT(bookings.tourCode) as bookings_count'))
        ->groupBy('tours.tourCode', 'tours.tourLanguages', 'tours.tourPrice', 'tours.tourStatus', 'tours.noOfSeats', 'tours.packageID', 'tours.flightID', 'tours.created_at', 'tours.updated_at')
        ->orderByDesc('bookings_count')
        ->take(3)
        ->get();

    return view('pages.reports', compact('bookings', 'totalAmount', 'selectedMonth', 'top3Tours'));
    
    }
}
