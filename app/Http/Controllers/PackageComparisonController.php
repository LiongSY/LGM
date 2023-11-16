<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageComparisonController extends Controller
{
    public function compare(Request $request)
    {
        $package1Details = Package::where('packageID', $request->input('package1'))->first();
        $package2Details = Package::where('packageID', $request->input('package2'))->first();

        return view('comparison', compact('package1Details', 'package2Details'));
    }
}