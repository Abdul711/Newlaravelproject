<?php


namespace App\Http\Controllers\Admin\Tax;
use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['data']=Tax::all();
        
        return view('admin/tax/tax',$result);
    }

    
    public function manage_tax(Request $request,$id='')
    {
        if($id>0){
            $arr=Tax::where(['id'=>$id])->get(); 
            $result['page_title']='Update Tax';
            $result['page_btn']='Update Tax';
            $result['tax_desc']=$arr['0']->tax_desc;
            $result['tax_value']=$arr['0']->tax_value;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }else{
            $result['tax_desc']='';
            $result['tax_value']='';
            $result['status']='';
            $result['id']=0;
            $result['page_title']='Add Tax';
            $result['page_btn']='Add Tax';
        }
        return view('admin/tax/manage_tax',$result);
    }

    public function manage_tax_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'tax_value'=>'required|unique:taxes,tax_value,'.$request->post('id'),   
        ]);

        if($request->post('id')>0){
            $model=Tax::find($request->post('id'));
            $msg="Tax updated";
        }else{
            $model=new Tax();
            $msg="Tax inserted";
        }
        $model->tax_desc=$request->post('tax_desc');
        $model->tax_value=$request->post('tax_value');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/tax');
        
    }

    public function delete(Request $request,$id){
        $model=Tax::find($id);
        $model->delete();
        $request->session()->flash('message','Tax deleted');
        return redirect('admin/tax');
    }

    public function status(Request $request,$status,$id){
        $model=Tax::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Tax status updated');
        return redirect('admin/tax');
    }
}
