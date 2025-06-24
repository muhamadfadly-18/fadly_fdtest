<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $unverifiedUsers = $totalUsers - $verifiedUsers;

        $totalBooks = Book::count();


        $booksPerDay = Book::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(7)) // ambil 7 hari terakhir
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');


        return view('dashboard', compact('verifiedUsers', 'unverifiedUsers', 'totalBooks', 'booksPerDay'));
    }
}
