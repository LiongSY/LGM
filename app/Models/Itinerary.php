<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{

    public function package() {
        return $this->hasOne(Package::class);
    }
    protected $fillable = [
        'packageID','noOfDays', 'hotelName', 'meals', 'information','remarks'
    ];}
