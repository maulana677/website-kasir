<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Alert;
use App\Models\Category;
use App\Traits\FileUploadTrait;

class MenuController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->get();
        return view('admin.menu.index', [
            'menus' => $menus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menu.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'category_id' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image', 'max:5000'],
        ]);

        $imagePath = $this->uploadImage($request, 'image');
        $menu = new Menu();
        $menu->image = $imagePath;
        $menu->name = $request->name;
        $menu->category_id = $request->category_id;
        $menu->price = $request->price;
        $menu->save();

        toastr()->success('Created Successfully!');
        return redirect()->route('admin.menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();

        $menusEdit = Menu::findOrFail($id);
        return view('admin.menu.edit', [
            'menusEdit' => $menusEdit,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image', 'max:5000'],
        ]);

        $menu = Menu::findOrFail($id);
        /** Handle Image Upload */
        $imagePath = $this->uploadImage($request, 'image', $menu->cover);

        $menu->image = !empty($imagePath) ? $imagePath : $menu->image;
        $menu->name = $request->name;
        $menu->category = $request->category;
        $menu->price = $request->price;
        $menu->save();

        toastr()->success('Updated Successfully!');
        return redirect()->route('admin.footer-social.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
