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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    public function show(){
        $product=Product::all();

        return view('admin.product',["subcategories"=>$product]);

    }
    public function destroy_attr($attr_id,$product_id){
        $model_attri=ProductAttribute::find($attr_id);
        
        $model_attri->delete();
      return redirect("admin/products/manage_products/$product_id");
    }
    public function manage($id=''){
                    if($id!=''){
                        $product_data=DB::table('products')->
                        join('categories','categories.id','=','products.categories_id')->
                        join('sub_categories','sub_categories.id','=',
            'products.sub_categories_id')->
                        join('brands','brands.id','=','products.brand')->
                        select('sub_categories.id as sub_category_id',
                        'categories.id as category_id',
                        'brands.id as brands_id',
                        'products.product_name',
                        'products.image',
                        'products.id as product_id',
                        'products.status',
                        )->
                        where(['products.id'=>$id])->get();
                        $product_data=json_decode($product_data,true);
                        $product_attributes=DB::table('products')->
                        join('product_attributes','product_attributes.product_id','=','products.id')->
               
                 
                        select(
                        'product_attributes.id as attr_id',
                        'product_attributes.product_id','product_attributes.sku','product_attributes.qty',
                        'product_attributes.color_id','product_attributes.size_id','product_attributes.price','product_attributes.mrp')->
                        where(['products.id'=>$id])->get();
                        $product_attributes=json_decode($product_attributes,true);

                        $page_data['page_title']='Update Product';
                        $page_data['page_btn']='Update Product';     
                
                     $heading="Update Product";
                  
                     }else{
                         $page_data['page_title']='Add Product';
                         $page_data['page_btn']='Add Product';
                        $product_attributes[0]['attr_id']='';
                        $product_attributes[0]['product_id']='';
                        $product_attributes[0]['color_id']='';
                        $product_attributes[0]['size_id']='';
                        $product_attributes[0]['sku']='';
                        $product_attributes[0]['price']='';
                        $product_attributes[0]['mrp']='';
                        $product_attributes[0]['qty']='';
                        $product_data[0]['product_name']='';
                        $product_data[0]['sub_category_id']=''; 
                        $product_data[0]['category_id']=''; 
                        $product_data[0]['brands_id']='';
                        $product_data[0]['product_id']='';
                        $product_data[0]['status']='';
                        $product_data[0]['image']='';
                        $heading="Add Product";
                     }
            /*         echo "<br> $heading";
                     echo"<pre>";
                    print_r($product_attributes);
                    echo"</pre>";*/
            
                    /* echo "<pre>";
                     print_r($product_attributes);
                     echo "</pre>";
                     echo "<pre>";
                     print_r($product_data);
                     echo "</pre>";*/
                     
        $category_data=Category::all();
        $sub_category=SubCategory::all();
        $color_data=Color::all();
        $size_data=Size::all();
        $brand_data=Brand::where(['status'=>'1'])->get();
        return view('admin.manage_product',['categories'=>$category_data,
        'colors'=>$color_data,'subcategories'=>$sub_category,
        'sizes'=>$size_data,'brands'=>$brand_data,
        'product_data'=>$product_data,"product_attr"=>$product_attributes],$page_data);
    }
    public function manage_product_process(Request $request){
             
        $price_array= $request->post('price');
          $qty_array=$request->post('qty');
          $color_array= $request->post('color_id');
          $size_array=$request->post('size_id');
          $mrp_array=$request->post('mrp');
          $sku_array=$request->post('sku');
         $product_attr_id_array=$request->post('paid');
          $product_name=$request->post('name');
          $product_category=$request->post('category');
          $product_subcategory=$request->post('subcategory');
           $product_id=$request->post('id');
          $product_brand=$request->post('brand');
          $product_status=1;
      
            if($request->hasfile('image')){
                $product_image=$request->file('image');
                $ext=$product_image->extension();
                $product_image_name=rand()+time().'.'.$ext;
                $product_image->storeAs('public/media',$product_image_name);
                       /* $fileloc="app/public/media/"."/"."2352295053.jpg";
                         $filename = storage_path($fileloc);
                         
                        if(File::exists($filename)) {
                            File::delete($filename);
                        }*/
            }
            else{
                $product_image_name='';
            }
          if($product_id==null){
            $product_status=1;
            $model=new Product();
          }else{#
            
    
            $model=Product::find($product_id);
             $product_status=$model->status;
          }
          
 
       
    
          if(!$request->hasFile("image")){
            $message="Image Required";

            $request->session()->flash("error_message",$message);
            
            return redirect($request->headers->get('referer'));
          }
          if($product_name==null ){
            $message="Product Name Required";

            $request->session()->flash("error_message",$message);
            
            return redirect($request->headers->get('referer'));
          }else{
          $valid_name="/[A-Za-z]{3,14}/i";
           if(preg_match_all($valid_name,$product_name)){
            $model->product_name=$product_name;
    $model->sub_categories_id=$product_subcategory;
    $model->categories_id=$product_category;
    $model->brand=$product_brand;
    $model->image=$product_image_name;
   $model->status=$product_status;
    $model->save();
  $product_id=$model->id;

 
   
                
         foreach($price_array as $key => $value){
    
          $qty=$qty_array[$key];
          $price=$price_array[$key];
        
          $sku=$sku_array[$key];
          $mrp=$mrp_array[$key];
    
          if($price==null && $price==""){
            $new_model_product=Product:: find($product_id);
            $new_model_product->delete();
            $message="Price Of attribute Must Be Filled Out";
            $request->session()->flash("error_message",$message);
            return redirect($request->headers->get('referer'));
          }     
          if($mrp==null && $mrp==""){
            $new_model_product=Product:: find($product_id);
            $new_model_product->delete();
            $message="Mrp Of attribute Must Be Filled Out";
            $request->session()->flash("error_message",$message);
            return redirect($request->headers->get('referer'));
          }
          if($qty==null && $qty==""){
            $new_model_product=Product:: find($product_id);
            $new_model_product->delete();
            $message="Qty Of attribute Must Be Filled Out";
            $request->session()->flash("error_message",$message);
            return redirect($request->headers->get('referer'));
          }    
          if($sku==null && $sku==""){
            $new_model_product=Product:: find($product_id);
            $new_model_product->delete();
            $message="Sku Of attribute Must Be Filled Out";
            $request->session()->flash("error_message",$message);
            return redirect($request->headers->get('referer'));
          }    
         
          

         
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
            $color=$color_id;
            $size=$size_id;
            if($product_attr_id_array[$key]==null){
                 "Atttribute id Not Found";
                $model=new ProductAttribute();                   
            }else{
               $attr_f_id= $product_attr_id_array[$key];
               "Atttribute id Found $attr_f_id";
               $model=ProductAttribute::find($attr_f_id);
            }

            
    
       
     
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
      return redirect('admin/products');             
           }else{
            $message="You Have Entered Invalid Product Name";

            $request->session()->flash("error_message",$message);
            
            return redirect($request->headers->get('referer'));
           }
          }

    /* $model->save()*/;
   
    
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
        'products.status'
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
        'product_attributes.price as attribute_price',
        'colors.color_name as p_att_c_name',
        'sizes.size_name as p_att_size_name'
        )->
        where(['products.id'=>$id])->get();
 

  
       return view('admin.product_detail',$product_detail_array,['product_attributes'=>$data2]);
    }
     public function destroy($id)
    {
      
     $model=ProductAttribute::where(['product_id'=>$id]);
     
     $model->delete();
     $product_mmodel=Product::find($id);
     $image_name=$product_mmodel->image;
        $fileloc="app/public/media/"."/".$image_name;
                            $filename = storage_path($fileloc);
                         
                       if(File::exists($filename)) {
                          File::delete($filename);
                        
                        }
     $product_mmodel->delete();
    $message="Product Deleted";
    session()->flash("message",$message);
      return redirect('admin/products');
    }

}
     
    
