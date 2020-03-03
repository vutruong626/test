<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Note;
use App\Models\Register;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listBrief()
    {
        $query = Register::orderBy('id','DESC')->paginate(12);
        return view('back-end.file.list-user',compact('query'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validationBrief($id){
        $data = Register::where('id',$id)->first();
        $query = Note::where('registers_id','=',$data->id)->orderBy('id','DESC')->get();
        return view('back-end.file.validation',compact('data','query'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancelBrief(Request $request){
        // dd($request->all());
        if($request->registers_id){
            $register = Register::where('id', $request->registers_id)->first();
            $register->status = self::CANCEL;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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