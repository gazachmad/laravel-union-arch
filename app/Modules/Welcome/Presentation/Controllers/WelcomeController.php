<?php

namespace App\Modules\Welcome\Presentation\Controllers;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('Welcome::welcome');
    }
}
