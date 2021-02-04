<?php

namespace App\Http\Controllers;

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
         
            $result['brand_id']=$arr['0']->id;
         }else{

        $result['brand_btn']='Add Brand';
        $result['brand_title']='Add Brand';
        $result['brand_name']='';
        $result['brand_id']='';
         }
        return view('admin.manage_brand',$result);
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
        if($brand_id=='' && $brand_id==null){
    
        if($brand_name=="" && $brand_name==null){
            $request->session()->flash('error_message','Please Enter The Brand Name');
            return redirect ('admin/brand/manage_brand');
        }else{
        $total_record= Brand::where('brands',$brand_name)->count();
        
        
           if($total_record>0){
                $request->session()->flash('error_message',"This Brand $brand_name Already Exists");
             
                return redirect ('admin/brand/manage_brand')->withInput();
            }else{
                $request->session()->flash('success_message',"This Brand $brand_name Has Been Added Successfully");
                $model=new Brand();
            
                $model->brands=$brand_name;
                $model->status=1;
                $model->save();
                
                return redirect ('admin/brand');
            }
        }   
   

        }else{
            if($brand_name=="" && $brand_name==null){
                $request->session()->flash('error_message',"Brand Name Required");
             
                return redirect ("admin/brand/manage_brand/$brand_id");
            }else{
                $total_record= Brand::where('brands',$brand_name)->count();
        
        
                if($total_record>0){
                   
             
                    $model=Brand::find($brand_id);
                 $message="Brand $brand_name Has Been Updated Successfully";
                   
                }else{
                    $model=new Brand();
                    $message="Brand $brand_name Has Been Added Successfully";
                }
                $model->brands=$brand_name;
                $model->status=1;
                $model->save();
                $request->session()->flash('success_message',$message);
                return redirect('admin/brand');
            }

        
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
       return view('admin.brand',["brands"=>$brand_data]);
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
