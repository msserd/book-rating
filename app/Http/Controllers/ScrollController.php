<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ScrollController extends Controller
{
    public function index()
    {
        return Inertia::render('Scroll');
    }
}
