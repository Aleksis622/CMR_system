<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CaseRecord;
use App\Models\UserRecord;

class DashboardController extends Controller
{
    /**
     * Only authenticated users can access dashboard
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show dashboard after login
     */
    public function index()
    {
        $user = Auth::user();

        // Example data to display on dashboard
        $totalCases = CaseRecord::count();
        $activeUsers = UserRecord::where('active', true)->count();

        return view('dashboard', [
            'user' => $user,
            'totalCases' => $totalCases,
            'activeUsers' => $activeUsers
        ]);
    }
}


