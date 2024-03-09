<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $category = new Category();
        return  view('dashboard.categories.create', compact('parents', 'category'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $data = $request->except('image');
        if ($request->has('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');


            // dd($path);
            $data['image'] = $path;
        }
        Category::create($data);
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
        $old_image = $request->image;
        $data = $request->except('image');

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public'
            ]);

            $data['image'] = $path;
        }


        $category->update($request->all());

        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect('/dashboard/categories');
    }


    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect('/dashboard/categories');
    }
}
