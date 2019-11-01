<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Tag;
use App\ProductTag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function all_product(Request $request){
        return Product::all();
    }

    public function show_product ($id) {
        return Product::where('id',$id)->first();
    }


    public function storeProduct(Request $request){
        $data = $request->all();
        $tags = $data['tags'];
        unset($data['tags']);
        $product =  Product::create($data);
        $product_tags = [];
        if(sizeof($tags)>0){
            foreach ($tags as  $value) {
                $ob = [];
                $ob['product_id'] = $product->id;
                $ob['tag_id'] = $value;
                array_push($product_tags,$ob);
            }
            ProductTag::insert($product_tags);

        }

        return $product;
    }

    public function updateProduct(Request $request){
        $data = $request->all();
        return Product::where('id',$data['id'])->update($data);
    }


    public function delete_Product(Request $request){
        $data = $request->all();
        return Product::where('id',$data['id'])->delete();
    }
    
}
