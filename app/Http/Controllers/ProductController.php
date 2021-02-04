<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;

class ProductController extends Controller
{

    public function manage($id=''){

        $category_data=Category::all();
        
        $color_data=Color::all();
        $size_data=Size::all();
        return view('admin.manage_product',['categories'=>$category_data,'colors'=>$color_data,
        'sizes'=>$size_data]);
    }
    public function manage_product_process(Request $request){
          $price_array= $request->post('price');
          $qty_array=$request->post('qty');
          $color_array= $request->post('color_id');
          $size_array=$request->post('size_id');
          $mrp_array=$request->post('mrp');
          
           return $request->post();
         foreach($price_array as $key => $value){
       
         
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

       
     echo         " qty is". $qty=$qty_array[$key];
        echo        " price is". $qty=$price_array[$key];
           echo     " color is". $color=$color_id;
              echo  " size is". $size=$size_id;


         }
     

     
 
        
        
    }
    
}