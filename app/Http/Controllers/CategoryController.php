<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller{

    public function all_Category(){
        return Category::all();
    }
    public function storeCategory(Request $request){
        $data = $request->all();
        return Category::create($data);
    }
    public function updateCategory(Request $request){
        $data = $request->all();
        \Log::info($data);
        return Category::where('id',$data['id'])->update($data);
    }
    public function delete_Category(Request $request){
        $data = $request->all();
        return Category::where('id',$data['id'])->delete();
    }
}
