<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\Brand;
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
        $brand_data=Brand::where(['status'=>'1'])->get();
        return view('admin.manage_product',['categories'=>$category_data,
        'colors'=>$color_data,'subcategories'=>$sub_category,
        'sizes'=>$size_data,'brands'=>$brand_data]);
    }
    public function manage_product_process(Request $request){
             
        $price_array= $request->post('price');
          $qty_array=$request->post('qty');
          $color_array= $request->post('color_id');
          $size_array=$request->post('size_id');
          $mrp_array=$request->post('mrp');
          $sku_array=$request->post('sku');
          $product_name=$request->post('name');
          $product_category=$request->post('category');
          $product_subcategory=$request->post('subcategory');
          
          $product_brand=$request->post('brand');
          $product_status=1;

            if($request->hasfile('image')){
                $product_image=$request->file('image');
                $ext=$product_image->extension();
                $product_image=rand()+time().'.'.$ext;
              
            }
            else{
                $product_image='';
            }


       
          $product_model=new Product();
         $product_model->product_name=$product_name;
         $product_model->categories_id=$product_category;    
         $product_model->sub_categories_id=$product_subcategory;
         $product_model->brand=$product_brand;
         $product_model->status=$product_status;
         $product_model->image=$product_image;
 
        $product_model->save();
       $product_id=$product_model->id;
                
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

$model->price=$price;
$model->mrp=$mrp;
$model->sku=$sku;
$model->size_id=$size;
$model->sku=$sku;
$model->color_id=$color;
$model->qty=$qty;
$model->product_id=$product_id;
$model->save();    
  
return redirect('admin/products');       

        }
    }

     public function view_detail($id)
    {  
       $data=DB::table('products')->
        join('categories','categories.id','=','products.categories_id')->
        join('sub_categories','sub_categories.id','=','products.sub_categories_id')->
        join('brands','brands.id','=','products.brand')->
        select('sub_categories.sub_category_name',
        'categories.category_name',
        'brands.brands',
        'products.product_name',
        'products.image',
        'products.id as Product_id',
        'products.status',
        )->
        where(['products.id'=>$id])->get();
    

  $data=json_decode($data,true);
  $status=$data[0]['status'];
  if($status==1){
      $new_status="Active";
  }
  elseif($status==0){
    $new_status="Deactive";
}
  $product_detail_array['product_name']=$data[0]['product_name'];
  $product_detail_array['category']=$data[0]['category_name'];
  $product_detail_array['sub_category']=$data[0]['sub_category_name'];
  $product_detail_array['brand']=$data[0]['brands'];
  $product_detail_array['status']=$new_status;
  $product_detail_array['old_status']=$data[0]['status'];
 
        $data2=DB::table('products')->
        join('product_attributes','product_attributes.product_id','=','products.id')->
        join('sizes','product_attributes.size_id','=','sizes.id')->
        join('colors','product_attributes.color_id','=','colors.id')->
        select('product_attributes.id as p_attr_id',
        'product_attributes.product_id as p_id',
        'colors.color_name as p_att_c_name',
        'sizes.size_name as p_att_size_name'
        )->
        where(['products.id'=>$id])->get();
 
        $data2=json_decode($data2,true);
  
       return view('admin.product_detail',$product_detail_array);
    }

}
     
    
