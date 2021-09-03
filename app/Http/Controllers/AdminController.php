<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $adminsList = Admin::all();
        return view('admin.admin_management.index', ["adminsList" => $adminsList]);
    }
    public function getDataList()
    {
        $adminDataList = Admin::all();
        return json_encode($adminDataList);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admin_management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        //

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->email = $request->email;
        $admin->role = $request->role;
        if ($request->file('avatar')) {
            $avatarPath = $request->file('avatar')->store('images/admin', 'public');
            $admin->avatar = 'storage/' . $avatarPath;
        }

        try {
            $result = $admin->save();
            if ($result) {
                return back()->with('success', "Đã tạo thành công Admin user: [username: $request->username,password: $request->password]!");
            } else {
                return back()->with('error', "Có lỗi xảy ra!");
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            return back()->with('error', "Có lỗi xảy ra!" . " </br>Error:$message");
        }
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
        $admin = Admin::findOrFail($id);

        if ($admin) {
            return view('admin.admin_management.update', ['admin' => $admin]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        //
        $admin = Admin::findOrFail($id);
        $admin->name=$request->name;
        $admin->username=$request->username;
        $admin->email= $request->email;
        if($request->file('avatar')){
            if($admin->avatar!='images/default-user.jpg'){
                //xóa ảnh cũ
            }
            $path=$request->file('avatar')->store('images/admin','public');
            $admin->avatar='storage/'.$path;
        }
        $result = $admin->save();
        if($result){
            return back()->with('success','Đã lưu!');
        }else{
            return back()->with('error','Có lỗi xảy ra!');
        }
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
        $result= Admin::destroy($id);
        if($result){
            return redirect(route('admins.index'))->with('success',"Đã xóa Admin có id: $id");
        }
    }
}
