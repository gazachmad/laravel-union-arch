<?php

namespace App\Modules\Welcome\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        return view('Welcome::welcome');
    }
}
