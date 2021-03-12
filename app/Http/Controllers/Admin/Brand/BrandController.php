<?php

namespace App\Http\Controllers\Admin\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id='')
    { 


         if($id !=''){
            $arr=Brand::where(['id'=>$id])->get(); 

            $result['brand_name']=$arr['0']->brands;
            $result['brand_btn']='Update Brand';
            $result['brand_title']='Update Brand';
            $result['brand_show_at_home']=$arr['0']->show_at_home;     
            $result['brand_id']=$arr['0']->id;
            $result['brand_image']=$arr['0']->brand_image;
         }else{
      
        $result['brand_btn']='Add Brand';
        $result['brand_title']='Add Brand';
        $result['brand_name']='';
        $result['brand_id']='';
        $result['brand_image']='';
        $result['brand_show_at_home']='1';
         }
   /*  echo "<pre>";
         print_r($result);
         echo "</pre>";
         die('con');*/
        return view('admin.brand.manage_brand',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
    
        $brand_id= $request->post('brand_id');
        $brand_name= $request->post('brand_name');
        $show_at_home= $request->post('at_home');
        $link=$request->headers->get('referer');  
               




   



        $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
    'brand_name'=>'required|min:1|unique:categories,category_name'
             
             
              
        ],[
      
            'brand_name.required'=>'Category Name must Be filled Out ',   
            'brand_name.min'=>'Category Name Must Consist Of atleast 3 Character', 
            'brand_name.unique'=>'Category AlReady Exists', 
            'barnd_name.max'=>'Category Name must Be less then 24 characters '
        ]);   

             if ($validator->fails()) {
             return redirect($link)->withErrors($validator);
             /*withInput()*/;
            }else{


                if($brand_id!=''){
                    $message="Brand Updated";
                    $brand_model= Brand::find($brand_id);
                    $brand_status=$brand_model->status;
                    if($request->hasFile('image')){
                     $image=$request->file('image');
                     $image_name=time().'.'.$image->extension();
                    $image->storeAs('/public/media/brand',$image_name);
                    $brand_model->brand_image=$image_name;
                    }else{
              
                    $image_name=$brand_model->brand_image;
                        $brand_model->brand_image=$image_name;
                    }

                }else{
                    $message="Brand Added";
                 $brand_model= new Brand;
                 if($request->hasFile('image')){
                     $image=$request->file('image');
                     $image_name=time().'.'.$image->extension();
                    $image->storeAs('/public/media/brand',$image_name);
                    $brand_model->brand_image=$image_name;
                
                 }
                 $brand_status=1;
               }

            
                $brand_model->show_at_home=$show_at_home;
                $brand_model->brands=$brand_name;
                $brand_model->status=$brand_status;
                $brand_model->save();
                session()->flash("success_message",$message);
              return redirect('admin/brand');
            } 

   
             


      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
    
       $brand_data=Brand::all();
       return view('admin.brand.brand',["brands"=>$brand_data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update_status($brand,$status)
    {
        //   
        $brand_model=Brand::find($brand); 
        $brand_name= $brand_model->brands;
          if($status==1){
              $new_status=0;
            $message="  $brand_name Deactived SuccessFully";
          }else {
            $new_status=1;
            $message="  $brand_name  Actived Successfully";
          }

            $model=Brand::find($brand);
            $model->status=$new_status;
            $model->save();
    
            session()->flash('success_message',$message);
            return redirect('admin/brand');
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Brand::find($id);
      $brand_name=  $model->brands;
        $model->delete();
        session()->flash("success_message","$brand_name Deleted");
         return redirect('admin/brand');
 
    }
}
