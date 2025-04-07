<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;



class Survey extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'created_by',
    ];

    public function getCreatedAtAttribute($value)
    {
        // return Carbon::parse($value)->format('d M Y, h:i A');
        return Carbon::parse($value)->setTimezone('Asia/Karachi')->format('d M Y, h:i A');
    }
}

  