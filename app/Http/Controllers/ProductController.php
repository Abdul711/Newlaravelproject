<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
      public function show(){
       
      
   
        $data=DB::table('products')->
   join('categories','categories.id','=','products.categories_id')->
   join('sub_categories','sub_categories.id','=','products.sub_categories_id')->
   select('categories.category_name','sub_categories.sub_category_name',
   'products.id','products.status','products.product_name','products.created_at')->get();

$data=json_decode($data,true);



     return view('admin.product',["subcategories"=>$data]); 
   
   
   
    

      }
      public function view_detail($id){
        $data=DB::table('products')->
        join('categories','categories.id','=','products.categories_id')->
        join('sub_categories','sub_categories.id','=','products.sub_categories_id')->
        select('categories.category_name','sub_categories.sub_category_name',
        'products.id','products.status','products.product_name','products.created_at')->where(['products.id'=>$id])->
        get();
       $category_name= $data['0']->category_name;
       $sub_category_name= $data['0']->sub_category_name;
       $product_name= $data['0']->product_name;
       $status= $data['0']->status;
       if($status==1){
           $new_status="Active";
       }else {
         $new_status="Deactive";
       }

         $data=['category'=>$category_name,'status'=>$new_status,'sub_category'=>$sub_category_name,'product'=>$product_name];




         return view('admin.product_detail',$data);
    
      }
      public function manage($id=''){
        if($id>0){
            $arr=Product::where(['id'=>$id])->get(); 
    
            $result['product_name']=$arr['0']->product_name;
             $result['product_btn']="Update Product";
             $result['product_title']="Update Product";
            $result['product_id']=$arr['0']->id;
            $result['category_id']=$arr['0']->categories_id;
            $result['sub_category_id']=$arr['0']->sub_categories_id;
        }else{
            $result['product_name']='';
            $result['product_btn']="Add Product";
            $result['product_title']="Add Product";
            $result['product_id']='';
            $result['category_id']='';
            
        }
        $categories_data=Category::all();
        $sub_categories_data=SubCategory::all();
        $color_data=Color::all();
        $size_data=Size::all();
        return view('admin.manage_product',$result,['sub_categories'=>
        $sub_categories_data,'categories'=>$categories_data,'sizes'=>$size_data,
        'colors'=>$color_data]);
      }
       public function  manage_product_process(Request $request)
      { 
        $price= $request->post('price');
         echo "Price Array";
        echo "<pre>";
        print_r($price);
        echo "</pre>";
        $images=$request->file('image');
            foreach($images as $key => $image){
        $ext=$image->extension();
        $time_s=time();
       echo $file_name=$time_s.$key.'.'.$ext;
            }

      }
}
