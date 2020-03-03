<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;
use Validator;
use DB;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Note;
use App\Models\Register;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.login.login');
    }

    public function getAdmin(Request $request){
        $login = [
            'username' => $request->username,
            'password' => $request->password,
            
        ];
        dd(Auth::user());
        if (Auth::attempt($login)) {
            return redirect()->route('list_user');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('back-end.login.sign-up');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'fullname.required' => 'Vui lòng nhập họ tên',
            'username.required' => 'Vui lòng nhập email',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng chọn địa chỉ   ',
            'password.required' => 'Vui lòng chọn Quận/huyện',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else if ($this->existsEmailUser($request['email'])) {
            return back()->with('err',"email đã tồn tại vui lòng nhập email khác");
        } else {
            $data = new User();
            $data->role_id = 1;
            $data->fullname = $request->fullname;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->password = Hash::make($request->password);
            if($data->save()){
                return back()->with('success_login',"Bạn đã đăng ký thành công");
            } else {
                return redirect()->route('login')->back()->with('error',"Bạn đăng ký không thành công");
            }
        } 
    }

    public function existsEmailUser($email){
        return User::where('email',$email)->exists();
    }

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
    public function listUser()
    {

        $users = User::all();
        return view('back-end.login.list-user',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $user = User::where('id',$id)->first();
        if(Gate::denies('edit-user')){
            return redirect()->route('list_user');
        }
        
        $role = Role::all();
        return view('back-end.login.edit-user',compact('role','user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {

        $user = User::first();
        // $user->roles->sync($request->roles);
        $user->roles()->sync($request->roles);

        return redirect()->route('list_user');
    }
}
