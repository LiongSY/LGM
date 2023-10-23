<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $primaryKey = 'tourCode';
    protected $fillable = [
        'departureDate', 'tourLanguages', 'tourPrice', 'tourStatus', 'noOfSeats', 'flightNumber'
    ];}
