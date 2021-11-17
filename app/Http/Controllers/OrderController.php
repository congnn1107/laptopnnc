<?php

namespace App\Http\Controllers;

use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $statusArray;
    public function __construct()
    {
        $this->statusArray = ['Đã hủy', 'Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng'];
    }
    public function index()
    {
        //
        return view('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.order.create');
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
        $customerInput = $request->all(['name', 'phone', 'email', 'address']);
        $customer = Customer::where('phone', $customerInput['phone'])->first();
        if (!$customer) {
            $customer = Customer::create($customerInput);
        }
        $productInput = $request->input('products');
        // dd($productInput);
        $details = [];
        for ($i = 0; $i < count($productInput['id']); $i++) {

            $product =  Product::findOrFail($productInput['id'][$i]);
            $price = $product->stock()->orderBy('created_at', 'DESC')->first()->sell_price;
            $discounts = $product->discount;
            $discounted = 0;
            foreach ($discounts as $discount) {
                if ($discount->type == 1) {
                    $discounted += $price * $discount->discounted_rate * 0.01;
                } else {
                    $discounted += $discount->discounted_amount;
                }
            }

            $details[] = [
                'product' => $product->id,
                'quantity' => $productInput['quantity'][$i],
                'price' => $price,
                'discounted' => $discounted,
                'final_price' => ($price - $discounted) * $productInput['quantity'][$i]
            ];
        }
        // dd($details);
        $order = Order::create(['customer' => $customer->id, 'address' => $request->input('address')]);
        // foreach ($details as $detail) {
        //     $result = $order->detail()->create($detail);
        // }
        $result = $order->detail()->createMany($details);

        return redirect(route('order.show',$order->id))->with('success', 'Đã tạo hóa đơn!');
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
        $order = Order::findOrFail($id);
        return view('admin.order.show', ['order'=>$order,'statusArray' => $this->statusArray]);
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
    public function searchProduct(Request $request)
    {

        $data = [];
        if ($request->search != "") {
            $result = Product::where('name', 'like', "%$request->search%")->orWhere('sku', 'like', "%$request->search%")->get();

            foreach ($result as $item) {
                $data[] = [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            }
        }
        //trả về mảng kết quả
        return response()->json($data);
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
