<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Article;
use App\Models\User;

class AdminDashboardController extends Controller
{

    public $restful = true; 
    public $folder = 'admin';
    public $link = '/admin/dashboard';
    public $pags = 50; 

    public function index()
    {
        $totalUsers = User::count();
        $usersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $usersToday = User::whereDate('created_at', today())->count();

        $monthlyUsers = collect(range(11, 0))->map(function ($monthsAgo) {
            $date = now()->subMonths($monthsAgo);
            return [
                'month' => $date->translatedFormat('M Y'),
                'count' => User::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
            ];
        });

        $latestUsers = User::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'usersThisMonth',
            'usersToday',
            'monthlyUsers',
            'latestUsers'
        ));
    }
}