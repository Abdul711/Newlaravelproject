<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function show(){
        $product=Product::all();
        return view('admin.product',["subcategories"=>$product]);
    }
    public function manage($id=''){
    
    
        $category_data=Category::all();
        $sub_category=SubCategory::all();
        $color_data=Color::all();
        $size_data=Size::all();
        return view('admin.manage_product',['categories'=>$category_data,
        'colors'=>$color_data,'subcategories'=>$sub_category,
        'sizes'=>$size_data]);
    }
    public function manage_product_process(Request $request){
             
        $price_array= $request->post('price');
          $qty_array=$request->post('qty');
          $color_array= $request->post('color_id');
          $size_array=$request->post('size_id');
          $mrp_array=$request->post('mrp');
          $sku_array=$request->post('sku');
      
         foreach($price_array as $key => $value){
          $model=new ProductAttribute() ;  
         
              if($color_array[$key]=='' && $color_array[$key]=null ){
                  $color_id=0;
              }else{
                  $color_id= $color_array[$key];
              }
              if($size_array[$key]=='' && $size__array[$key]=null){
                $size_id=0;
            }else{
                $size_id= $size_array[$key];
            }

       
       $qty=$qty_array[$key];
       $price=$price_array[$key];
       $color=$color_id;
       $size=$size_id;
       $sku=$sku_array[$key];
       $mrp=$mrp_array[$key];
            
                
$total_record= DB::table('product_attributes')->where(['sku'=>$sku])->count();
$product_id=1;
$model->price=$price;
$model->mrp=$mrp;
$model->sku=$sku;
$model->size_id=$size;
$model->sku=$sku;
$model->color_id=$color;
$model->qty=$qty;
$model->product_id=$product_id;
$model->save();    
  
       

        }
    }
}
     
    
