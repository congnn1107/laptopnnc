<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('shop.wishlist', ['categories'=>Category::where('parent_id', 0)->get()]);
    }

    public function add($id){
        //nếu tồn tại thì xóa
        $user = Auth::user();

        // dd($user->wishlist()->delete($id));
        if($product = $user->wishlist()->where('product',$id)->first()){
            if($product->delete()){
                return response()->json(['success' => true,'message'=> 'Đã xóa khỏi danh sách!']);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra!']);
            }
            
        }

        //nếu chưa tồn tại thì thêm
        if($user->wishlist()->create(['product' => $id,'user'=>$user->id])){
            return response()->json(['success' => true, 'message' => 'Đã thêm vào danh sách mua sau!']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra!']);
        }
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
        //đưa mã sản phẩm vào form gửi post request đến hàm store
        //lấy mã sản phẩm từ request
        //lưu vào db
        //redirect kèm thông báo kết quả
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
        $record = Wishlist::findOrFail($id);
        if($record->user == Auth::user()->id){
           $record->delete();

        }
        else{
            abort(401);
        }
        return back();

    }
}
