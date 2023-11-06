<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    public function tours()
    {
        return $this->hasMany(Tour::class, 'packageID','packageID');
    }
    public function itinerary() {
        return $this->belongsTo(Itinerary::class);
    }
    protected $fillable = [
        'packageID','packageImage','packageName','highlight', 'itineraryPdf', 'remarks', 'destination', 'itineraryID', 'singleRoom','doubleRoom','tripleRoom'
    ];}
