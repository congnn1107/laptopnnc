<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Warranty::all();
        return view('admin.product.warranty.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $statusList = ['Chưa kích hoạt','Đã kích hoạt','Hết hạn'];
        $productList = Product::all();
        return view('admin.product.warranty.create', compact('productList','statusList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO
        //validate form
        $request->validate([
            'product'=>['integer','min:1']
        ],[
            'product.min' => 'Vui lòng chọn sản phẩm!',
        ]);

        $options = $request->all('product','emei','sold_at','actived_at','expired','status','customer_email','customer_phone','info');
        if(Warranty::create($options)){
            return back()->with('success','Đã lưu dữ liệu!');
        }
        else{
            return back()->with('error','Có lỗi xảy ra!');
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
        $warranty = Warranty::findOrFail($id);
        $statusList = ['Chưa kích hoạt','Đã kích hoạt','Hết hạn'];
        $productList = Product::all();
        return view('admin.product.warranty.edit',compact('warranty','statusList','productList'));
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
