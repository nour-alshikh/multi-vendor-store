<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {

        $parents = Category::all();
        return  view('dashboard.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        Category::create($request->all());
        return redirect('/dashboard/categories');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();
        return  view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->all());
        return redirect('/dashboard/categories');
    }


    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect('/dashboard/categories');
    }
}
