<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $journals = Journal::query()->with(['coordinator:id,name', 'category:id,name', 'employee:id,name']);

        if (Auth::user()->role == 'employee') {
            $journals = $journals->where('employee_id', Auth::id());
        } else {
            $journals = $journals->where('coordinator_id', Auth::id());
        }

        $journals = $journals->orderBy('updated_at', 'desc')->paginate(10);

        return view('journal.index', compact(
            'journals',
        ));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'coordinator_id' => 'required',
            'category_id' => 'required',
            'timing' => 'required',
            'description' => 'required',
            'target' => 'required',
            'status' => 'required',
            'comment' => ''
        ]);

        $validated['employee_id'] = 1;

        Journal::query()->create($validated);

        return to_route('journal.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Journal $journal): View
    {
        $categories = Category::all();
        $coordinators = User::query()->where('role', 'coordinator')->get();

        return view('journal.edit', compact('journal', 'categories', 'coordinators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Journal $journal): RedirectResponse
    {
        $validated = $request->validate([
            'coordinator_id' => 'required',
            'category_id' => 'required',
            'timing' => 'required',
            'description' => 'required',
            'target' => 'required',
            'status' => 'required',
            'comment' => ''
        ]);

        $validated['employee_id'] = 1;

        $journal->update($validated);

        return to_route('journal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journal $journal): RedirectResponse
    {
        $journal->delete();

        return to_route('journal.index');
    }
}
