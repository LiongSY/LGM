<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $primaryKey = 'passportNo';
    protected $fillable = [
        'expiryDate', 'passportImage'
    ];}
