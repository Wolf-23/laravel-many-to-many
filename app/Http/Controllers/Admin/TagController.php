<?php

namespace App\Http\Controllers\Admin;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{

    protected function slugCalc($title) {
        $slug = Str::slug($title, '-');
        $check = Tag::where('slug', $slug)->first();
        $counter = 1;
        while($check) {
            $slug = Str::slug($title . '-' . $counter . '-');
            $counter++;
            $check = Tag::where('slug', $slug)->first();
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
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
                'name' => 'required|max:255',
            ]
            );
            $data = $request->all();
            $tag = new Tag;
            $tag->fill($data);
            $slug = $this->slugCalc($tag->name);
            $tag->slug = $slug;
            $tag->save();
            return redirect()->route('admin.tags.index')->with('status', 'Tag creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate(
            [
                'name' => 'required|max:255'
            ]
        );
        $data = $request->all();
        if ($tag->name !== $data['name']) {
            $data['slug'] = $this->slugCalc($data['name']);
        }
        $tag->update($data);
        $tag->save();
        return redirect()->route('admin.tags.index')->with('status', 'La modifica al tag è stata apportata!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->sync([]);
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('deleted', 'Il tag è stato eliminato!');
    }
}
