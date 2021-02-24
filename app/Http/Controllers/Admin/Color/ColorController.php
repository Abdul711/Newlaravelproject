<?php
namespace App\Http\Controllers\Admin\Color;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ColorController extends Controller
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
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
          $data=Color::all();
        return view('admin.color.color',['categories'=>$data]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        //
    }
    public function manage($id='')
    {
   
    if($id>0){
        $arr=Color::where(['id'=>$id])->get(); 

        $result['color_name']=$arr['0']->color_name;
         $result['color_btn']="Update Color";
         $result['color_title']="Update Color";
        $result['color_id']=$arr['0']->id;
    }else{
        $result['color_name']='';
        $result['color_btn']="Add Color";
        $result['color_title']="Add Color";
        $result['color_id']='';
        
    }
    return view('admin/color/manage_color',$result);

}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update_status($id,$status)
    {
        //
      
            if($status==1){
                $message= " Color Deactived ";
                $new_status="0";
            }elseif($status==0){
           
               $message= "Color Actived ";
               $new_status="1";
       
            }
          $total_record= Color::where('id',$id)->count();
          if($total_record>=1){
         $model=Color::find($id);
         $model->status=$new_status;
         $model->save();
         session()->flash("message",$message);
         return redirect('admin/color');
          }
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */

    public function manage_color_process(Request $request)
    {
        //   
 
       $color_id= $request->post('color_id');

           if($color_id!=null){
            $link="admin/color/manage_color/".$color_id;
            }
            else{
                $link="admin/color/manage_color";
            }
             
        
          
           $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
                 'color_name'=>'required|min:3|max:24|unique:colors,color_name,'.$request->post('color_id'),
             
             
              
        ],[
      
            'color_name.required'=>'Color Name must Be filled Out ',   
            'color_name.min'=>'Color Name Must Consist Of atleast 3 Character', 
            'color_name.unique'=>'Color AlReady Exists', 
            'color_name.max'=>'Color Name must Be less then 24 characters '
        ]);   

             if ($validator->fails()) {
             return redirect($link)->withErrors($validator);
        
            }else{
               $color_name= $request->post('color_name');
               $color_id=$request->post('color_id');
               if($color_id==null){
                $message="Color Inserted";
                 $model=new Color();
               }else{
                $message="Color Updated";
                   $model=Color::find($color_id);
               }

               
               $model->status="1";
               $model->color_name=$color_name;
               $model->save();
            
               $request->session()->flash("message","$message");
      
                return redirect('admin/color');
            }

    }

    public function destroy(Color $color,$color_id)
    {
        //
        echo $color_id;
        $model=Color::find($color_id);
        $model->delete();
        $message="Deleted Successfully";
        session()->flash("message","$message");
        return redirect('admin/color');
    }
}
