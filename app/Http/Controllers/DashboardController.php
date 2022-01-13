<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log_operator;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'log' => Log_operator::with('operator','shift')->orderBy('created_at','DESC')->limit(10)->get(),
        ];
        return view('dashboard.dashboard-02', $data);
    }
}
