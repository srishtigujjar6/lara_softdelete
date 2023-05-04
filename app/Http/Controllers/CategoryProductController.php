<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryProductController extends Controller
{
    public function storeData(){
        $category = new Category();
        $category->name = 'Baggs';
        $category->save();

        $product = new Product();
        $product->name = 'Tourist';
        $product->price = 2000;
        $product->save();
    }
    
    // The default Pivot Model instantiated when using a belongs to many relationship does not use the SoftDeletes trait.
    
    public function attachData(){
        $id = 2;
        $category = Category::find($id);
        if($category){
            $category->products()->sync([1]);
        }
    }
    
    public function deleteData(){
        $id = 2;
        $category = Category::find($id);
        if($category){
            dd($category->delete());
        }
    }
}
