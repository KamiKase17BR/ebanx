<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    
    protected $fillable = [
        'id',
        'balance'
    ];

    public $timestamps = false;

}
