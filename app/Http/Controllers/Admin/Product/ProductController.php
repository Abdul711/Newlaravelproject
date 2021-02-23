<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data=Product::all();
     return view('admin.product.product',["data"=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function manage_product($id='')
    {
        
        if($id==''){
            $page_data['page_title']="Add Product";
            $page_data['page_btn']="Add Product";
             $product_data['product_name']='';
            $product_data['category_id']='';
            $product_data['sub_category_id']='';
            $product_data['image']='';
            $product_data['brand_id']='';
            $product_data['id']='';
            $product_data['featured']='1';
            $product_data['availability']='1';
            $product_attributes[0]['id']='';
            $product_attributes[0]['color_id']='';      
            $product_attributes[0]['size_id']='';
            $product_attributes[0]['qty']='';
            $product_attributes[0]['price']='';
            $product_attributes[0]['sku']='';
            $product_attributes[0]['mrp']='';
            $product_attributes[0]['attr_image']='';
            $product_attributes[0]['price_after_tax']='';
            $product_attributes[0]['tax_id']='';
            $product_image_collect[0]['images']='';
            $product_image_collect[0]['id']='';
        }else{
            $product_dat=DB::table('products')->where(['id'=>$id])->get();
            $pn=$product_dat[0]->product_name;
            $product_name=Crypt::decryptString($pn);
           /* echo"<pre>";
            print_r($product_dat);
            echo"</pre>";*/
           $product_data['product_name']=$product_name;
           $product_data['category_id']=$product_dat[0]->category_id;
           $product_data['sub_category_id']=$product_dat[0]->sub_category_id;;
           $product_data['image']=$product_dat[0]->image;
           $product_data['brand_id']=$product_dat[0]->brand_id;
           $product_data['id']=$product_dat[0]->id;
           $product_data['featured']=$product_dat[0]->featured;
           $product_data['availability']=$product_dat[0]->availability;
              $product_attributes=ProductAttribute::where(['product_id'=>$id])->get();
            $product_attributes=json_decode($product_attributes,true);
            $page_data['page_title']="Update Product";
            $page_data['page_btn']="Update Product";
            $product_images=ProductImage::where(['product_id'=>$id])->get();
            $product_images=json_decode($product_images,true);
             $total_image=count($product_images);
               if($total_image<=0){
                   $product_image_collect[0]['images']='';
                   $product_image_collect[0]['id']='';
               }else{
                   $product_image_collect=$product_images;
               }

             

        }
    
      $color_data=Color::where(['status'=>'1'])->get(); 
      $color_data=json_decode($color_data,true);  
      $size_data=Size::where(['status'=>'1'])->get(); 
      $size_data=json_decode($size_data,true);  
      $category_data=Category::where(['status'=>'1'])->get(); 
      $category_data=json_decode($category_data,true); 
      $sub_category_data=SubCategory::where(['status'=>'1'])->get(); 
      $sub_category_data=json_decode($sub_category_data,true); 
      $brand_data=Brand::where(['status'=>'1'])->get(); 
      $brand_data=json_decode($brand_data,true); 
      $tax_data=Tax::where(['status'=>'1'])->get(); 
      $tax_data=json_decode($tax_data,true); 
  
       return view('admin.product.manage_product',$page_data,[
           "product_data"=>$product_data,
           "product_attributes"=>$product_attributes,
           "colors"=>$color_data,
           "sizes"=>$size_data,
           "categories"=>$category_data,
           "subcategories"=>$sub_category_data,
           "brands"=>$brand_data,
           "taxes"=>$tax_data,
           "product_images"=>$product_image_collect
           ]);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function manage_product_process(Request $request)
    {
/* echo  $link=$request->headers->get('referer');  
       echo "<pre>";     
       print_r($request->post());
    
       echo "</pre>";  
       die();*/
       
       




        
        if($request->post('id')==''){
        $name_valid="required|min:3|max:24|unique:products,product_name";
        $image_valid="required|mimes:jpg,png";
        }else{
            $name_valid="required|min:3|max:24";
            $image_valid="mimes:jpg,png";
        }
       $name_valid;
        $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
             'name'=>$name_valid,
             'image'=>$image_valid,
             'tax_id.*'=>'required'
             
              
        ],[
      
            'name.required'=>'Product Name must Be filled Out ',   
            'name.min'=>'Product Name Must Consist Of atleast 3 Character', 
            'name.unique'=>'Product AlReady Exists', 
            'name.max'=>'Product Name must Be less then 24 characters ',
            
            'tax_id.*.required'=>'Tax Is Required'
        ]);   
       $link=$request->headers->get('referer');
             if ($validator->fails()) {
             return redirect($link)->withErrors($validator);
             /*withInput()*/;
            }else{





   $previous_link=$request->headers->get('referer');
   $product_id=$request->post('id');
   $category_id=$request->post('category_id');
   $sub_category_id=$request->post('sub_category_id');
   $brand_id=$request->post('brand_id');
   $product_name=$request->post('name');
   $availability=$request->post('available');
   $featured=$request->post('feature');

   /* Get Value For Product Attribute */
   $product_attr_id_array=$request->post('paid');
   $product_attr_price_array=$request->post('price');
   $product_attr_mrp_array=$request->post('mrp');
   $product_attr_qty_array=$request->post('qty');
   $product_attr_color_array=$request->post('color_id');
   $product_attr_size_array=$request->post('size_id');
   $product_attr_sku_array=$request->post('sku');
   $product_attr_tax_id_array=$request->post('tax_id');
      /* Get Value For Product Image */
   $product_images_id_array=$request->post('piid'); 
   
        if($product_id==null && $product_id==''){
           $product_model=new Product();
           $new_status=1;
          $new_av_status=1;
           $message="Product Inserted";
         if($request->hasFile('image')){
             $image=$request->file('image');
             $image_name=mt_rand()+rand().".".$image->extension();
             $image->storeAs('/public/media',$image_name);
             $product_model->image=$image_name;



         }

        }else{
            $product_model=Product::find($product_id);
          $old_image=$product_model->image;
  

            if($request->hasFile('image')){
                if(Storage::exists('/public/media/',$old_image)){
             
                 Storage::delete("/public/media/$old_image");
                }
                
                $image=$request->file('image');
                $image_name=mt_rand()+rand().".".$image->extension();
                $image->storeAs('/public/media',$image_name);
                $product_model->image=$image_name;
         
   
   
            }else{
                $product_model->image=$old_image;  
            }
                 
   
            $new_av_status=$product_model->availability;      
            $new_status=$product_model->status;
            $message="Product Updated";
        }
   
   
    
        $product_model->featured=$featured;
        $product_model->availability=$availability;
        $product_model->product_name=$product_name;
        $product_model->category_id=$category_id;
        $product_model->sub_category_id=$sub_category_id;
        $product_model->brand_id=$brand_id;
        $product_model->status=$new_status;
  
        $product_model->save();
        
        $product_id=$product_model->id;

      
        foreach ($product_attr_id_array as $key => $value) {
            $attr_id=$product_attr_id_array[$key];
           $attr_price=$product_attr_price_array[$key];
               $attr_mrp=$product_attr_mrp_array[$key];
               $attr_qty=$product_attr_qty_array[$key];
               $attr_size=$product_attr_size_array[$key];
               $attr_color=$product_attr_color_array[$key];
               $attr_sku=$product_attr_sku_array[$key];
               $attr_tax_id=$product_attr_tax_id_array[$key];
               $attr_tax=Tax::find($attr_tax_id);
               $tax_value=$attr_tax->tax_value;
                $tax_value=floor(($tax_value/100)*$attr_price);
               $attr_price_after_tax=$tax_value+$attr_price;
                if($attr_id=='' && $attr_id==null){
                  
                     $attribute_model=new ProductAttribute();
                    if($request->hasFile("attr_image.$key")){
                        $image_attr=$request->file("attr_image.$key");
                        $image_name=mt_rand().".".$image_attr->extension();
                        $image_attr->storeAs('/public/media/attr_image',$image_name);
                        $attribute_model->attr_image=$image_name;
                    }
                }else{
                    $attribute_model=ProductAttribute::find($attr_id);
               
        
               

                    $old_attribute_image=$attribute_model->attr_image;
                    if($request->hasFile("attr_image.$key")){
                        $old_attribute_image=$attribute_model->attr_image;
                        if(Storage::exists('/public/media/attr_image',$old_attribute_image)){
             
                            Storage::delete("/public/media/attr_image/$old_attribute_image");
                        }
                       $image_attr=$request->file("attr_image.$key");
                       $image_name=mt_rand().".".$image_attr->extension();
                       $image_attr->storeAs('/public/media/attr_image',$image_name);
                       $attribute_model->attr_image=$image_name;
                    }else{
                       $attribute_model->attr_image=$old_attribute_image;
                    }
                  
                     "attribute id  found";
                }
                $attribute_model->color_id=$attr_color;
                $attribute_model->size_id=$attr_size;
                $attribute_model->price=$attr_price;
                $attribute_model->mrp=$attr_mrp;
                $attribute_model->sku=$attr_sku;
                $attribute_model->qty=$attr_qty;
                $attribute_model->product_id=$product_id;
                $attribute_model->tax_id=$attr_tax_id;
                $attribute_model->price_after_tax=$attr_price_after_tax;
              $attribute_model->save();
           }     
      
      
           foreach ($product_images_id_array as $key => $product_images) {
            $image_id=$product_images_id_array[$key];
          if($request->hasFile("images.$key")){
           $product_image=$request->file("images.$key");
           $image_name=rand();
           $image_name=$image_name+time();
           $product_image_name=$image_name.'.'.$product_image->extension();
             $product_image->storeAs('/public/media/product_images',$product_image_name);
              if($image_id=='' && $image_id==null)
             {
             $product_image_model=new ProductImage();
             }else{
               $product_image_model=ProductImage::find($image_id);
             }
            
               $product_image_model->images=$product_image_name;
               $product_image_model->product_id=$product_id;  
               $product_image_model->save();
           }

      }
         
      
      
      
      
      
      

      
        session()->flash("message",$message);
       return redirect('admin/product');
    }
    }
    public function status(Request $request,$product_id,$status)
    {
        $product_model_status=Product::find($product_id);
       $product_name=$product_model_status->product_name;
        if($status==0){ 
            $message="Product Activated SuccessFully";
             $new_status="1";
        }else{
            $message="Product Dectivated SuccessFully";
            $new_status="0";
        }
        $product_model_status->status=$new_status;
        $product_model_status->save();
        session()->flash("message",$message);
        $link=$request->headers->get('referer');
        return redirect($link);
    }
     public function product_attr_delete($product_id,$attr_id)

     {
        $attribute_model=ProductAttribute::find($attr_id);
       $attr_image=$attribute_model->attr_image;
      if(Storage::exists('/public/media/attr_image/',$attr_image)){
             
        Storage::delete("/public/media/attr_image/$attr_image");
       }
       session()->flash("message","Attribute Deleted Successfully");
        $attribute_model->delete();
       $link="admin/product/manage_product/$product_id";
        return redirect($link);
     }
     public function product_images_delete($image_id,$product_id)

     {
        $attribute_model=ProductImage::find($image_id);
       $attr_image=$attribute_model->images;
      if(Storage::exists('/public/media/product_images/',$attr_image)){
             
        Storage::delete("/public/media/product_iamges/$attr_image");
       }
       session()->flash("message","Product Image Deleted Successfully");
        $attribute_model->delete();
       $link="admin/product/manage_product/$product_id";
        return redirect($link);
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($product_id)
    {
        //
       $product_attr_data=DB::table('product_attributes')->where(['product_id'=>$product_id])->get();
       $product_image_data=DB::table('product_images')->where(['product_id'=>$product_id])->get();
       $product_data=DB::table('products')->where(['id'=>$product_id])->get();
       $product_data=json_decode($product_data,true);
       $product_attr_data=json_decode($product_attr_data,true);
       $product_image_data=json_decode($product_image_data,true);
              foreach ($product_data as $key => $value) {
                 $image_to_delete=$value['image'];
     if(Storage::exists('/public/media/',$image_to_delete)){
             
            Storage::delete("/public/media/$image_to_delete");


        }
              }
                 foreach ($product_image_data as $key => $value2) {
                 $image_to_delete=$value2['images'];
     if(Storage::exists('/public/media/product_images',$image_to_delete)){
             
            Storage::delete("/public/media/product_images/$image_to_delete");


        }
              }

              foreach ($product_attr_data as $key => $value) {
                $image_to_delete=$value['attr_image'];
             if(Storage::exists('/public/media/attr_image/',$image_to_delete)){
                     
                    Storage::delete("/public/media/attr_image/$image_to_delete");
        
        
                }
              }
              DB::table('product_attributes')->where(['product_id'=>$product_id])->delete();
         
              DB::table('product_images')->where(['product_id'=>$product_id])->delete();
              DB::table('products')->where(['id'=>$product_id])->delete();



        $message="Product Deleted";
              session()->flash("message",$message);       
         return redirect('admin/product');
           
    }
}
