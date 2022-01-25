<?php

namespace App\Http\Controllers;

use App\Model\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
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
        // dd($request->input());
        //kiểm tra xem email này đã mua sản phẩm này chưa
        $count = DB::table('order')
        ->join('customer','order.customer','=','customer.id')
        ->join('order_detail','order_detail.order','=','order.id')
        ->join('product','product.id','=','order_detail.product')
        ->where('customer.email',$request->input('email'))
        ->where('product.id',$request->input('product'))->where('order.status',3)
        ->count();

        if($count>0){
            $options= [
                'product' => $request->input('product'),
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'content' => $request->input('comment'),
                'points' => $request->input('point'),
            ];
            $result = Review::create($options);
            
        }
        //lưu

        //load lại
        return back();
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
