<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected function slugCalc($title) {
        $slug = Str::slug($title, '-');
        $check = Category::where('slug', $slug)->first();
        $counter = 1;
        while($check) {
            $slug = Str::slug($title . '-' . $counter . '-');
            $counter++;
            $check = Category::where('slug', $slug)->first();
        }
        return $slug;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255'
            ]
            );
            $data = $request->all();
            $category = new Category;
            $category->fill($data);
            $slug = $this->slugCalc($category->name);
            $category->slug = $slug;
            $category->save();
            return redirect()->route('admin.categories.index')->with('status', 'Categoria creata con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(
            [
                'name' => 'required|max:255'
            ]
        );
        $data = $request->all();
        if ($category->name !== $data['name']) {
            $data['slug'] = $this->slugCalc($data['name']);
        }
        $category->update($data);
        $category->save();
        return redirect()->route('admin.categories.index')->with('status', 'La modifica alla categoria è stata apportata!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('deleted', 'La categoria è stata eliminata!');
    }
}
