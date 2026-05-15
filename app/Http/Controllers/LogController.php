<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index() {
        if (auth()->user()->role !== 'admin') abort(403, 'Acesso negado.');

        $logs = Activity::with('causer')->latest()->get();
        return view('logs.index', compact('logs'));
    }
}
