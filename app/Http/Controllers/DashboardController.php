<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jemaat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
