<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //
    public $destination;
    public function __construct(Request $request)
    {
    }
    public function login()
    {
        return view("admin.login");
    }

    public function checkLogin(Request $request)
    {
        // dd($request);
        $request->validate([
            "username" => ["required"],
            "password" => "required",
        ]);

        $credentials = [
            "username" => $request->username,
            "password" => $request->password
        ];
        $remember = isset($request->remember) ? true : false;

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with("message", "Tài khoản hoặc mật khẩu không chính xác!");
    }


    public function dashboard()
    {
        $products =  Product::offset(0)->limit(6)->orderBy('created_at', 'desc')->get();
        $orderStatus = ['Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng', 'Đã hủy'];
        $orderStatusColor = ['yellow', 'orange', 'blue', 'green', 'red'];
        $newOrders = Order::with('detail', 'customer')->offset(0)->limit(6)->orderBy('created_at')->get();
        $totalProduct = Product::count();
        $totalOrder = Order::count();
        $totalUser = User::count();
        $totalSoldProduct = OrderDetail::join('order', 'order_detail.order', '=', 'order.id')->where('status', '!=', '5')->sum('quantity');
        // dd($totalProduct);
        $report = [];
        DB::enableQueryLog();
        $orders = Order::with('detail');

        $countOrderData = DB::table('order')->select([DB::raw('date(created_at) as day'), DB::raw('count(id) as orders')]);

        if (request()->query('reportBy')) {
            $now = Carbon::now();

            if (request()->query('reportBy') == 'month') {
                $firstDay = new Carbon('first day of this month');
                $countOrderData = DB::table('order')->select([DB::raw('day(created_at) as day'), DB::raw('count(id) as orders')]);
            } else {
                $firstDay =  new Carbon();
                $firstDay->startOfWeek();
                $countOrderData = DB::table('order')->select([DB::raw('dayname(created_at) as day'), DB::raw('count(id) as orders')]);
            }
            $orders = $orders->whereBetween('created_at', [$firstDay->format('Y-m-d') . ' 00:00:00', $now->format('Y-m-d') . ' 23:59:59']);
            $countOrderData->whereBetween('created_at', [$firstDay->format('Y-m-d') . ' 00:00:00', $now->format('Y-m-d') . ' 23:59:59']);
        }

        $orders = $orders->get();
        // dd($orders->count());
        $getTurnOver = function () use ($orders) {
            $sum = 0;
            foreach ($orders  as $order) {
                $sum += $order->detail()->sum('final_price');
            }
            return $sum;
        };
        $getRaw = function () use ($orders) {
            $sum = 0;
            foreach ($orders as $order) {
                $details = $order->detail;
                foreach ($details as $detail) {
                    $product = $detail->product()->first();
                    $sum += $product->import_price;
                }
            }
            return $sum;
        };

        $report = [
            'orders' => $orders,
            'waiting' => $orders->where('status', 0)->count(),
            'accepted' => $orders->where('status', 1)->count(),
            'shipping' => $orders->where('status', 2)->count(),
            'received' => $orders->where('status', 3)->count(),
            'canceled' => $orders->where('status', 4)->count(),
            'turnOver' => $getTurnOver(),
            'raw' => $getRaw()
        ];


        // dd([DB::getQueryLog(),$report]);
        //xử lí dữ liệu biểu đồ
        $countOrderDataResult = $countOrderData->groupBy('day')->get();
        $countReceivedOrderData = $countOrderData->where('status',3)->get();
        // dd($countOrderDataResult);
        $data = [
            'products' => $products,
            'orderStatus' => $orderStatus,
            'newOrders' => $newOrders,
            'orderStatusColor' => $orderStatusColor,
            'totalProduct' => $totalProduct,
            'totalOrder' => $totalOrder,
            'totalUser' => $totalUser,
            'totalSoldProduct' => $totalSoldProduct,
            'report' => $report,
            'countOrderDataResult' => $countOrderDataResult,
            'countReceivedOrderData' =>$countReceivedOrderData

        ];
        

        return view("admin.dashboard", $data);
    }


    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $accessToken = auth("admin")->user()->setRememberToken("");

            Auth::guard('admin')->logout();
            session()->invalidate();
            session()->flush();
            session()->regenerateToken();
            return redirect(route("admin.login"));
        }
        return back();
    }
    public function profile(){
        return view('admin.profile');
    }
    public function updateProfile(Request $request){
       $old_password = $request->input('old_password');
       $user = Auth::guard('admin')->user();
       if(Hash::check($old_password,$user->password)){
         $request->validate([
            'password' => ['required','min:6'],
            'confirm' => ['same:password']
         ],[
            'password.required' => 'Mật khẩu không được trống!',
            'password.min' => 'Mật khẩu tối thiểu phải 6 ký tự!',
            'confirm.same' => 'Xác nhận mật khẩu thất bại!'
         ]);

         $user->update(['password'=>Hash::make($request->input('password'))]);
         return back()->with('success','Đổi mật khẩu thành công!');
       }
       else{
           return back()->withErrors(['old_password'=>'Mật khẩu không chính xác!'])->withInput();
       }
    }
}
