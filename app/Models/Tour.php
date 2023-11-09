<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tour) {
            // Delete associated flight
            $tour->flight()->delete();
        });
    }

     public function package()
     {
         return $this->belongsTo(Package::class,'packageID',);
     }

     public function flight() {
        return $this->hasOne(Flight::class, 'flightID', 'flightID');
      }
    protected $fillable = [
        'tourCode', 'tourLanguages', 'tourPrice', 'tourStatus', 'noOfSeats', 'packageID','flightID'
    ];}
