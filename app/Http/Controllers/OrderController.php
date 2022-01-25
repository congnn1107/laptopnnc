<?php

namespace App\Http\Controllers;

use App\Mail\Invoice;
use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
Use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $statusArray;
    protected $colorLabel;
    public function __construct()
    {
        $this->statusArray = [ 'Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng','Đã hủy'];
        $this->colorLabel= ['yellow','orange','blue','green','red'];
    }
    public function index()
    {
        //
        DB::enableQueryLog();
        $orders = Order::orderBy('created_at','desc');
        $counts = [
            Order::where('status',0)->count(),
            Order::where('status',1)->count(),
            Order::where('status',2)->count(),
            Order::where('status',3)->count(),
            Order::where('status',4)->count(),
        ];
        if(request()->query('from')){
            
            $orders->whereBetween('created_at',[request()->query('from'),request()->query('to')]);
        }
        // dd(request()->query('status'));
        if(request()->query('status')!=null){
            if(request()->query('status')>=0){
                $orders->where('status',request()->query('status'));
            }
        }
        $orders =$orders->get();
        
        // dd(DB::getQueryLog());
        return view('admin.order.index',['statusArray'=>$this->statusArray,'orders'=>$orders,'colorLabel'=>$this->colorLabel,'counts'=>$counts]);
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
    public function changeStatus(Request $request){
        $order = Order::findOrFail($request->input('order'));
        // trường hợp đơn hàng đã hoàn thành thì không thể thay đổi
        if($order->finished_at){
            return back()->with('error','Đơn hàng đã xác nhận hoàn thành, không thể thay đổi!');
        }

        //xử lí số lượng
        //trường hợp thay đổi từ trạng thái đã hủy sang trạng thái khác
        if($order->status==4){
            if($request->input('status')!=4){
                foreach($order->detail as $detail){
                    $detail->product()->first()->decrement('stock',$detail->quantity);
                }
            }
        }
        //trường hợp hủy
        if($order->status!=4){
            if($request->input('status')==4){
                foreach($order->detail as $detail){
                    $detail->product()->first()->increment('stock',$detail->quantity);
                }
            }
        }
        
        $order->status = $request->input('status');
        
        $order->admin = Auth::guard('admin')->user()->id;
        
        if($order->save()){
            return back()->with('success','Đã thay đổi trạng thái đơn hàng!');
        }
        else{
            return back('error','Có lỗi xảy ra!');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeForCustomer(Request $request)
    {
        // dd($request);
        //format address
        $addressInput = $request->input('address');
        // $address = "";
        // if (isset($addressInput[3])) {
            // $address.=$addressInput[3];
        // }

        // $ward= DB::table('ward')->where('id',$addressInput[2])->first(['id','_name','_prefix']);
        // $district = DB::table('district')->where('id',$addressInput[1])->first(['id','_name','_prefix']);
        // $province = DB::table('province')->where('id',$addressInput[0])->first(['id','_name']);
        // dd($ward);

        // $address .= ", $ward->_prefix $ward->_name, $district->_prefix $district->_name, $province->_name";

        $address = $addressInput;
        //process customer
        $customerInput = $request->all('name', 'phone', 'email');
        $customerInput['address'] = $address;
        $customer = Customer::where('email', $customerInput['email'])
            ->where('phone',$customerInput['phone'])->where('name',$customerInput['name'])->first();

        if (!$customer) {
            $customer = Customer::create($customerInput);
        }

        // dd($customer);
        //process order detail
        $productIDs = $request->input('product_id');
        $qty = $request->input('qty');
        $details = [];
        for ($i = 0; $i < count($productIDs); $i++) {

            $product =  Product::findOrFail($productIDs[$i]);
            $product->decrement('stock',$qty[$i]);

            // dd($product);
            //process promotions
            $price = $product->sell_price;
            $discounts = $product->discount;
            $discounted = 0;
            foreach ($discounts as $discount) {
                if ($discount->type == 0) {
                    $discounted += $price * $discount->discounted_rate * 0.01;
                } elseif($discount->type==1){
                    $discounted += $discount->discounted_amount;
                }
            }

            $details[] = [
                'product' => $product->id,
                'quantity' => $qty[$i],
                'price' => $price,
                'discounted' => $discounted,
                'final_price' => ($price - $discounted) * $qty[$i]
            ];
            // dd($details);
        }
        // dd($details);
        $orderCode = 'HD'.substr($customer->phone,6).Str::random(6);
        // dd($orderCode);
        $order = Order::create(['customer' => $customer->id,'phone'=>$request->input('phone'), 'address' => $address, 'order_code' => $orderCode]);
        // foreach ($details as $detail) {
        //     $result = $order->detail()->create($detail);
        // }
        $result = $order->detail()->createMany($details);
        //clear shopping cart
        Cart::destroy();
        //todo: gửi mail thông báo đặt hàng thành công
        $mailContent = [
            'title' => 'Cảm ơn bạn đã đặt hàng tại shop!',
            'order' => $order
        ];
        
        Mail::to($customer->email)->send(new Invoice($mailContent));

        return redirect(route('shop.product.index'))->with('success', 'Đã tạo hóa đơn, vui lòng kiểm tra email!');
        
    }

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
            $product->decrement('stock',$productInput['quantity'][$i]);
            // $product->save();
            $price = $product->sell_price;
            $discounts = $product->discount;
            $discounted = 0;
            foreach ($discounts as $discount) {
                if ($discount->type == 0) {
                    $discounted += $price * $discount->discounted_rate * 0.01;
                } elseif($discount->type==1) {
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
        Mail::to($customer->email)->send(new Invoice(['title'=>'Cảm ơn bạn đã đặt hàng tại shop!','order'=>$order]));
        return redirect(route('order.show', $order->id))->with('success', 'Đã tạo hóa đơn!');
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
        
        return view('admin.order.show', ['order' => $order, 'statusArray' => $this->statusArray]);
    }

    public function finishOrder($id){
        $order = Order::findOrFail($id);
        $result = false;
        if(!$order->finished_at){
            $result= $order->update(['finished_at'=>DB::raw('CURRENT_TIMESTAMP')]);
        }
        if($result){
            return back()->with('success','Đã xác nhận hoàn thành đơn hàng!');
        }else{
            return back()->with('error','Có lỗi xảy ra!');
        }
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
        Order::destroy($id);
        return back()->with('success','Đã xóa đơn hàng!');
    }
}
