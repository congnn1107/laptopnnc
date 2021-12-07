<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use App\Model\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $categories;
    public function __construct()
    {
        $this->categories = Category::where('parent_id',0)->get();
    }
    public function index()
    {
        //
        $sliders = Slider::where('type',1)->where('status','1')->orderBy('position')->get();
        // dd($sliders);
        $products = Product::offset(0)->limit(4)->orderBy('id','desc')->get();
        return view('shop.index',['sliders'=>$sliders,'products'=>$products,'categories' => $this->categories]);
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

    public function storePage(){
        $products = Product::orderBy('id','desc')->get();
        return view('shop.store',['categories' => $this->categories, 'products' => $products]);
    }
    public function showProduct($slug){
        $product = Product::where('slug',$slug)->first();
        if($product){
            return view('shop.product.show',['product' => $product, 'categories'=>$this->categories]);
        }
        else{
            return "Đéo thấy";
        }
    }
    public function contactPage(){
        return view('shop.contact',['categories' => $this->categories]);
    }
    public function checkOut(){
        if(Cart::count()==0) return back();
        return view('shop.checkout',['categories' => $this->categories]);
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
