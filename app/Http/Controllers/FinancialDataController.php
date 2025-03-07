<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// fetch
// app/Http/Controllers/FinancialDataController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class FinancialDataController extends Controller
{

    public function getCategoryDataIncome()
    {
        $categories = Category::all();
        $labels = $categories->pluck('name');
        $expenses = $categories->map(function ($category) {
            return $category->transactions->where('type', 'income')->sum('amount');
        });
        $colors = ['#22c55e', '#16a34a', '#86efac'];  // Example colors

        return response()->json(compact('labels', 'expenses', 'colors'));
    }

    public function getCategoryDataExpense()
    {
        $categories = Category::all();
        $labels = $categories->pluck('name');
        $expenses = $categories->map(function ($category) {
            return $category->transactions->where('type', 'expense')->sum('amount');
        });
        $colors = ['#22c55e', '#16a34a', '#86efac'];  // Example colors

        return response()->json(compact('labels', 'expenses', 'colors'));
    }
}
