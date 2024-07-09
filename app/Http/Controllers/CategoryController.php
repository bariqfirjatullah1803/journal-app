<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->orderBy('updated_at', 'DESC')->paginate(10);
        return view('category.index', [
            'categories' => $categories
        ]);
    }

    public function create(): View
    {
        return view('category.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        Category::query()->create($validated);

        return to_route('category.index');
    }

    public function edit(Category $category): View
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $category->update($validated);

        return to_route('category.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return to_route('category.index');
    }
}
