<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', [
            'categories' => Category::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        if (!$validatedData) return redirect()->back()->withErrors($validatedData)->withInput();

        $category = Category::create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name'])
        ]);

        if (!$category) return redirect()->to('admin/categories')->withErrors('Kategori gagal ditambahkan!');

        return redirect()->to('admin/categories')->with('info', 'Kategori <strong>' . $category->name . '</strong> berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('category.form', [
            'edit' => TRUE,
            'category' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        if (!$validatedData) return redirect()->back()->withErrors($validatedData)->withInput();

        $category = Category::find($id);

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);

        if (!$category->save()) return redirect()->to('admin/categories')->withErrors('Kategori gagal diubah!');

        return redirect()->to('admin/categories')->with('info', 'Kategori <strong>' . $category->name . '</strong> berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        if (!$category) return redirect()->to('admin/categories')->withErrors('Kategori gagal dihapus!');

        return redirect()->to('admin/categories')->with('info', 'Kategori <strong>' . $category->name . '</strong> berhasil dihapus.');
    }
}
