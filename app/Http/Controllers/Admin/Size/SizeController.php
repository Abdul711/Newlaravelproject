<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SizeController extends Controller
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
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size )
    {
      
        $data=Size::all();
    return view('admin.size.size',['categories'=>$data]);
    }
    public function manage($id='')
    {
   
    if($id>0){
        $arr=Size::where(['id'=>$id])->get(); 

        $result['category_name']=$arr['0']->size_name;
         $result['category_btn']="Update Size";
         $result['category_title']="Update Size";
        $result['category_id']=$arr['0']->id;
    }else{
        $result['category_name']='';
        $result['category_btn']="Add Size";
        $result['category_title']="Add Size";
        $result['category_id']='';
        
    }
    return view('admin/size/manage_size',$result);

      
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update_status($id,$status)
    {
        if($status==1){
            $message= " Size Deactived ";
            $new_status="0";
        }elseif($status==0){
       
           $message= "Size Actived ";
           $new_status="1";
   
        }
      $total_record= Size::where('id',$id)->count();
      if($total_record>=1){
     $model=Size::find($id);
     $model->status=$new_status;
     $model->save();
     session()->flash("message",$message);
     return redirect('admin/size');
      }        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size,$id)
    {
        $id;
        $model=Size::find($id);
         $model->delete();
         session()->flash("message","Size Deleted");
          return redirect('admin/size');
          //
    }
    public function manage_size_process(Request $request)
    {
        //  
 
        $size_id= $request->post('size_id');
        if($size_id!=null){
            $link="admin/size/manage_size/".$size_id;
            $message="Size Updated";
            }
            else{
                $link="admin/size/manage_size";
                $message="Size Inserted";
            }
        $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
                 'size_name'=>'required|unique:sizes,size_name,'.$request->post('size_id'),
             
             
              
        ],[
      
            'size_name.required'=>'Size must Be filled Out ',   
            
            'size_name.unique'=>'Size AlReady Exists', 
         
        ]);   

             if ($validator->fails()) {
             return redirect($link)->withErrors($validator);
             /*withInput()*/;
            }

if($size_id!=null){
    $model=Size::find($size_id);
}else{
$model=new Size();
}
$model->size_name=$request->post('size_name');
$model->status="1";
$model->save();
session()->flash("message","$message");
return redirect('admin/size');
    }
}
