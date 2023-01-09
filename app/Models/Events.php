<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    
    protected $fillable = [
        'id',
        'balance'
    ];

    protected $casts = [
        'balance' => 'integer',
        'id' => 'string'
    ];
    
    public $timestamps = false;

}
