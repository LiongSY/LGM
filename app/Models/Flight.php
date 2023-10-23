<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $primaryKey = 'flightNumber';
    protected $fillable = [
        'departureDate', 'returnDate', 'sector', 'airlines', 'departureTime', 'returnTime'
    ];}
