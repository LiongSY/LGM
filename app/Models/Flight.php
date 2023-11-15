<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'flightID', 'flightID');
    }
    protected $fillable = [
        'flightID','departureDate', 'arrivalDate', 'sector', 'airlines', 'departureTime', 'arrivalTime','flightNumber','returnDepartureDate', 'returnArrivalDate', 'returnSector', 'returnAirlines', 'returnDepartureTime', 'returnArrivalTime','returnFlightNumber',
    ];}
