<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\Audience;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        $stats = [
            'dossiers' => Dossier::count(),
            'audiences' => Audience::count(),
            'users' => User::count(),
        ];

        if ($role === 'juge') {
            return view('dashboards.juge', compact('stats'));
        } elseif ($role === 'greffier') {
            return view('dashboards.greffier', compact('stats'));
        } else { // admin
            return view('dashboards.admin', compact('stats'));
        }
    }
}
