<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $primaryKey = 'itineraryID';
    protected $fillable = [
        'noOfDays', 'hotelName', 'meals', 'information'
    ];}
