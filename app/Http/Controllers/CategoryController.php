<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isProducer');
    }
    
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
            
        ]);

        $category = Category::firstOrCreate([
            'name' => $request->name,            
        ]);

        if($category){
            session()->flash('message', 'Successful operation');
            return redirect(route('category.index'));
        }
        
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('category.edit', compact('category', 'categories'));
    }

    
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        if($category){
            session()->flash('message', 'Successful operation');
            return redirect()->route('category.index');
        }    
    }

    //EDIT FUNCCTION
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('message', "Deleted Successfully");
        return redirect()->route('category.index');
    }
}
