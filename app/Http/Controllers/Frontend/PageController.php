<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Note;

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
    public function index()
    {
        $query = Register::orderBy('id','DESC')->paginate(12);
        return view('front-end.index',compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front-end.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
            $data_find = Register::orderByRaw('cast(code AS SIGNED) DESC')->first();
            $code = ($data_find) ? ((int)($data_find->code) + 1).'' : 1000;
            $data               = new Register();
            $data->fullname     = $request->fullname;
            $data->user_id     = $request->user_id;
            $data->number_t     = $request->number_t;
            $data->number_th    = $request->number_th;
            $data->ward         = $request->ward;
            $data->district     = $request->district;
            $data->code     = $code;
            $data->status       = self::PENDING;
            $data->save();
            return redirect()->route('success')->with('success_registration',"Bạn đã đăng ký thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        $query = Register::orderBy('id','DESC')->take(1)->get();
        return view('front-end.success',compact(('query')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
