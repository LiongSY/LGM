<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'notificationID';
    protected $fillable = [
        'notificationMessage', 'staffID'
    ];}
