<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Note;

// use User;
class PageController extends Controller
{
    const CANCEL = 1;
    const PENDING = 2;
    const INPRORESS = 3;
    const COMPLETE = 4;  

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
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        
    }

    public function postAdmin(Request $request){
        $login = [
            'username' => $request->username,
            'password' => $request->password,
            
        ];
        if (Auth::attempt($login)) {
            return redirect()->route('get_user');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getUser(){
        $query = Register::orderBy('id','DESC')->paginate(12);
        return view('back-end.list-user',compact('query'));
    }

    public function validationBrief($id){
        $data = Register::where('id',$id)->first();
        $query = Note::where('registers_id','=',$data->id)->orderBy('id','DESC')->get();
        return view('back-end.authentication',compact('data','query'));
    }

    
    
    //     return redirect()->back()->with('status', 'Đủ điều kiện để duyệt'); 
    //  }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        return view('back-end.sign-up');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function createUser(Request $request)
    // {
    //     $rules = [
    //         'fullname' => 'required',
    //         'username' => 'required',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'password' => 'required',
    //     ];
    //     $messages = [
    //         'fullname.required' => 'Vui lòng nhập họ tên',
    //         'username.required' => 'Vui lòng nhập email',
    //         'email.required' => 'Vui lòng nhập email',
    //         'email.email' => 'Vui lòng nhập đúng định dạng email',
    //         'phone.required' => 'Vui lòng nhập số điện thoại',
    //         'address.required' => 'Vui lòng chọn địa chỉ   ',
    //         'password.required' => 'Vui lòng chọn Quận/huyện',
    //     ];

    //     $validator = Validator::make($request->all(), $rules, $messages);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     } 
    //     else if ($this->existsEmailUser($request['email'])) {
    //         return back()->with('err',"email đã tồn tại vui lòng nhập email khác");
    //     } else {
    //         $data = new User();
    //         $data->role_id = 1;
    //         $data->fullname = $request->fullname;
    //         $data->username = $request->username;
    //         $data->email = $request->email;
    //         $data->phone = $request->phone;
    //         $data->address = $request->address;
    //         $data->password = Hash::make($request->password);
    //         if($data->save()){
    //             return back()->with('success_login',"Bạn đã đăng ký thành công");
    //         } else {
    //             return redirect()->route('admin')->back()->with('error',"Bạn đăng ký không thành công");
    //         }
    //     } 
    // }

    // public function existsEmailUser($email){
    //     return User::where('email',$email)->exists();
    // }

    public function getListBriefByUser(){
        
        $query = Register::orderBy('id','DESC')->paginate(12);
        return view('back-end.manage.list-user',compact('query'));
    }
    public function validationBrief($id){
        $data = Register::where('id',$id)->first();
        $query = Note::where('registers_id','=',$data->id)->orderBy('id','DESC')->get();
        return view('back-end.manage.manage-authentication',compact('data','query'));
    }
    

    public function cancelValidationBrief(Request $request){
        // dd($request->all());
        if($request->registers_id){
            $register = Register::where('id', $request->registers_id)->first();
            $register->status = self::PENDING;
            if($register->save()) {
                if(!empty($request->description)){
                    $data = new Note();
                    $data->mhs = $request->mhs;
                    $data->registers_id = $request->registers_id;
        
                    $data->description = $request->description;
                    if(!$data->save()){
                        // warning
                        return redirect()->back()->with('status', 'Không đồng ý cấp vì chưa đủ điều kiện'); 
                    }
                }
            } else {
                // warning
                return redirect()->back()->with('status', 'Không đồng ý cấp vì chưa đủ điều kiện'); 
            }

        }
        return redirect()->back()->with('status', 'Không đồng ý cấp vì chưa đủ điều kiện'); 

    }
    public function successValidationBrief(Request $request){
        // dd($request->all());
        if($request->registers_id){
            $register = Register::where('id', $request->registers_id)->first();
            $register->status = self::COMPLETE;
            if($register->save()) {
                if(!empty($request->description)){
                    $data = new Note();
                    $data->mhs = $request->mhs;
                    $data->registers_id = $request->registers_id;
        
                    $data->description = $request->description;
                    if(!$data->save()){
                        // warning
                    }
                }
            } else {
                // warning
            }

        }
        return redirect()->back()->with('status', 'Hồ sơ đang duyệt'); 

    }
}
