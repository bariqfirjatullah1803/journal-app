<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $journals = Journal::query()->with(['coordinator:id,name', 'category:id,name', 'employee:id,name'])->whereDay('updated_at', now()->day);

        if (Auth::user()->role == 'employee') {
            $journals = $journals->where('employee_id', Auth::id());
        } else {
            $journals = $journals->where('coordinator_id', Auth::id());
        }

        $journals = $journals->orderBy('updated_at', 'desc')->paginate(10);

        $categories = Category::all();
        $coordinators = User::query()->where('role', 'coordinator')->get();

        return view('dashboard.index', compact(
            'journals',
            'categories',
            'coordinators'
        ));
    }
}
