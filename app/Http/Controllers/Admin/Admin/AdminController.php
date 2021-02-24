<?php

namespace App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function add_admin(){
         $admin_email="admin@gmail.com";
         $admin_password="admin123";
         $admin_mobile="03323565866";
         $admin_mode=Admin::where(['email'=>$admin_email])->get();
         $admin_model=new Admin();
     $total_count=Admin::where(['email'=>$admin_email])->count();
     $adm_pas=Hash::make($admin_password);
         if($total_count==0){
            $admin_role=1;
            $admin_model->email=$admin_email;
            $admin_model->mobile=$admin_mobile;
            $admin_model->password=$adm_pas;
            $admin_model->role=$admin_role;
            $admin_model->save();

         }else{
             session()->flash('message',"Admin Already Added");
              if(session()->has('ADMIN_LOGIN')){
                session()->forget('ADMIN_LOGIN');
              }

             return redirect('admin');
            
         }


     }
    public  function manage_admin_process(Request $request){
      $link=$request->headers->get('referer');
   
      $validator=Validator::make($request->all(),[
        /*|required|regex:/[A-Z]{2,}/i*/
        'vendor_mobile'=>'required',
        'vendor_email'=>'required',
        'admin_old_password'=>'required|regex:/[A-Za-z]{3,}[0-9]{1,}$/'
       ],[
    'admin_old_password.required'=>'Password Required To Update The Admin',    
    'admin_old_password.regex'=>'In Valid Password'    
       ]);
       if ($validator->fails()) {
        return redirect($link)
                    ->withErrors($validator)
                    ->withInput();   
       }else{
    
        session('ADMIN_ROLE');
         if(session()->has('ADMIN_ID')){
      $admin_id=session('ADMIN_ID');
      $admin_model=Admin::find($admin_id);
      $db_password=$admin_model->password;
      $admin_old_password=$request->post('admin_old_password');
      $admin_mobile=$request->post('vendor_mobile');
      $admin_password=$request->post('vendor_password');
      $admin_email=$request->post('vendor_email');
      if(Hash::check($admin_old_password,$db_password)){
    
          if($admin_password!=null){    
           $pattern="/[A-Za-z]{3,}[0-9]{1,}$/";
           $subject=$admin_password;
          if(!preg_match($pattern,$subject)){
            session()->flash('error_message','Invalid Password'); 
            return redirect($link);
          }


               if(Hash::check($admin_password,$db_password)){
              session()->flash('error_message','This Password Already Exists Enter New Password To Update Account'); 
              return redirect($link);
               }

             $new_password=Hash::make($admin_password);
            
           }else{
               $new_password=$admin_model->password;
           } 
           $admin_model->email=$admin_email;
           $admin_model->mobile=$admin_mobile;
           $admin_model->password=$new_password;
           $admin_model->save();
          session()->flash('success_message','Admin Update Successfully'); 
        return redirect($link);
      }else{
        session()->flash('error_message','Wrong Password Entered That Why Admin Connot Updated'); 
        return redirect($link);
      }

  
         }

            
       }
   
    }
    public function index()
    {
        //
        if(session()->has('ADMIN_LOGIN')){
          return redirect('admin/dashboard');
       }else{
         return view('admin.login');
      /*  return redirect('admin');*/
       }
   

     
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        //
        $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
                 'password'=>'required|regex:/[A-Za-z]{3,}[0-9]{1,}$/',
             
                 'email'=>'required|email',
              
           ],[
        
           'email.required'=>'Email Address Must be Provided',
           'email.email'=>'Correct Email Address Must Be Provided',
           'password.required'=>'Password Must be Provided',
            'password.regex'=>'Password Must Atleast 3 Alphabet With atleast one number'
           ]);   
          
             if ($validator->fails()) {
              return redirect('admin')
                          ->withErrors($validator)
                          ->withInput();
          }else{
           $password= $request->post('password');
             $email= $request->post('email');
          
           $result=Admin::where(['email'=>$email])->get();

           
              if(isset($result['0']->id)){
            
                $db_password=$result['0']->password;
                if(Hash::check($password,$db_password)){
                    $request->session()->put('ADMIN_LOGIN',true);
                    $request->session()->put('ADMIN_ID',$result['0']->id);
                    $request->session()->put('ADMIN_EMAIL',$result['0']->email);
                    $request->session()->put('ADMIN_ROLE',$result['0']->role);
                    return redirect('admin/dashboard');
                }else{
                    $request->session()->flash('error','Wrong Password');
                    return redirect('admin')->withInput();
                }
              }else{

                $request->session()->flash('error','this email address doesnot exist in our system');
                  return redirect('admin')->withInput();
              }
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function manage_account()
    {

 $admin_id=session('ADMIN_ID');   
 $admin_role=session('ADMIN_ROLE');   
$admin_data=Admin::where(['id'=>$admin_id])->get();

$result['admin_email']=$admin_data[0]->email;
$result['admin_mobile']=$admin_data[0]->mobile;
$result['admin_id']=$admin_data[0]->id;
$result['admin_role']=$admin_data[0]->role;

      $result['page_title']='Admin Manage Account';
      $result['admin_data']=$admin_data;

     return view('admin.manage_admin',$result);
    }
    public function dashboard()
    {
        //
        return view('admin.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    function update_admin($id=null){
     echo $id;
     if($id!=null){
       $admin_model=Admin::find($id);
       print_r($admin_model);
     }
    }   
}
