<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKue = Cake::count();
        $totalKategoriKue = Category::count();
        return view('admin.dashboard.index', compact('totalKue', 'totalKategoriKue'));
    }
}
