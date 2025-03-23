<?php

namespace App\Modules\Home\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $data = ['title' => 'Home', 'slug' => 'home'];

        return view('Home::home', $data);
    }
}
