<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Events;


class ResetController extends Controller
{
    
    public function index()
    {
        Events::truncate();

    }

    
}
