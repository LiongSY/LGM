<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'roomID';
    protected $fillable = [
        'roomType', 'roomPrice', 'roomDesc'
    ];}
