<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function convert(Request $request)
    {
                $currencyApi = new \CurrencyApi\CurrencyApi\CurrencyApiClient('cur_live_N2AijhNQYore6HWAWKikPNvQ96ww9HwV5ild2xXj');
                $response = $currencyApi->latest([
                    'base_currency' => 'MYR', 
                    'currencies' => 'USD,SGD,BND',
                ]);
            
                 if ($request->selectedCurrency === 'USD') {

                     Session::put('USDRate', $response['data']['USD']['value']);
                 } elseif ($request->selectedCurrency === 'SGD') {
                     Session::put('SGDRate', $response['data']['SGD']['value']);

                 } elseif ($request->selectedCurrency === 'BND') {
                     Session::put('BNDrate', $response['data']['BND']['value']);
                 } else {
                     Session::put('MYRRate', 1);
                 }

                 Session::put('selectedCurrency', $request->selectedCurrency);

            
                return redirect()->back();
            
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
