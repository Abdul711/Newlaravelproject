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
          $image_array=$request->file('attr_image');
       
         foreach($price_array as $key => $value){
       
         
              if($color_array[$key]==''){
                  $color_id=0;
              }else{
                  $color_id= $color_array[$key];
              }
              if($size_array[$key]==''){
                $size_id=0;
            }else{
                $size_id= $size_array[$key];
            }

       
              " qty is". $qty=$qty_array[$key];
                " price is". $qty=$price_array[$key];
               " color is". $color=$color_id;
                " size is". $size=$size_id;


         }


     
           $total_image=count($image_array);

           if($total_image>=1){
         for($i=0; $i< $total_image; $i++){
       $ext=$image_array[$i]->extension();
       $ti=floor( (time()/100)+rand()+ $i);
     $name=$key.$ti.'.'.$ext;
         }
        }

        
    }
    
}