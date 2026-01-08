<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $roles = ['admin', 'inspector', 'analyst', 'broker'];

        $chartData = User::where('active', true)
            ->selectRaw('role, COUNT(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role')
            ->toArray();

        return view('dashboard', [
            'user'             => Auth::user(),
            'totalCases'       => CaseModel::count(),
            'totalUsersCount'  => User::count(),
            'roles'            => $roles,
            'chartData'        => array_map(fn($r) => $chartData[$r] ?? 0, $roles),
        ]);
    }
}
