<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
class ProductController extends Controller
{
 public function show ()
    {
        $data=Product::all();
        $data=json_decode($data,true);
    return view('admin.product',['data'=>$data]);
    }
    public function manage($id='')
    { 
        if($id==""){
           $page_data['page_title']='Add Product';
           $page_data['page_btn']='Add Product';
           $product_data['id']='';
           $product_data['product_name']='';
           $product_data['categories_id']='';
           $product_data['sub_categories_id']='';
           $product_data['brand']='';
           $product_data['image']='';
           $product_attr_data[0]['id']='';
           $product_attr_data[0]['sku']='';
           $product_attr_data[0]['color_id']='';
           $product_attr_data[0]['qty']='';
           $product_attr_data[0]['price']='';
           $product_attr_data[0]['mrp']='';
           $product_attr_data[0]['size_id']='';
           $product_attr_data[0]['image']='';

        }else{
            $page_data['page_title']='Update Product';
            $page_data['page_btn']='Update Product';
            $product_data=json_decode(Product::where(['id'=>$id])->get(),true);
            $product_attr_data=json_decode(ProductAttribute::where(['product_id'=>$id])->get(),true);
            $product_data=$product_data[0];
        }
        $category_data=Category::all();
        $sub_category_data=SubCategory::all();
        $color_data=Color::all();
        $size_data=Size::all();
        $brand_data=Brand::all();
       $category_data=($category_data);
    

    
        return view('admin/manage_product',$page_data,["product_data"=>$product_data,
        "categories"=>$category_data,"subcategories"=>$sub_category_data
        ,"brands"=>$brand_data,"sizes"=>$size_data,"colors"=>$color_data,"product_attributes"=>$product_attr_data]);
        # code...
    }
    public function manage_product_process(Request $request){
        echo "Previous Page Link ".$previous_page=$request->headers->get('referer');
        $data= $request->post();
      echo "<pre>";
       print_r($data);

       echo "</pre>";
   
    }
}
