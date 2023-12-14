<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $createLink = route('product.category.create');

        $categories = Category::latest()->paginate(10);

        return view('product.category.index', compact('categories', 'createLink'));
    }

    public function create(){
        $indexLink = route('product.category.index');
        $storeLink = route('product.category.store');

        return view('product.category.create', compact('indexLink', 'storeLink'));
    }

    public function store(Request $request){
        Category::create($request->all());

        toast('Kategori berhasil ditambah!', 'success');
        return redirect()->route('product.category.index');
    }

    public function edit(Category $category){
        $updateLink = route('product.category.update', $category);
        $indexLink = route('product.category.index');

        return view('product.category.edit', compact('category', 'updateLink', 'indexLink'));
    }

    public function update(Category $category, Request $request){
        $category->update($request->all());

        toast('Kategori berhasil diupdate!', 'success');
        return redirect()->route('product.category.index');
    }

    public function destroy(Category $category){
        $category->delete();

        toast('Kategori berhasil dihapus!', 'success');
        return back();
    }
}
