<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductStock;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    //

    protected $productsList;

    public function __construct()
    {
        $this->productsList = Product::all();
    }

    public function index()
    {

        return view('admin.product.stock.index', ['productsList' => $this->productsList]);
    }

    public function manage($product_id)
    {

        $product = Product::findOrFail($product_id);
        if ($product) {
            return view('admin.product.stock.manage', ['product' => $product]);
        } else {
            return back()->with('error', 'Không ổn dồi, có lỗi xảy ra!');
        }
    }
    public function store(Request $request, $product_id)
    {

        //
        $request->validate([], []);

        $result = ProductStock::create(['product' => $product_id,'quantity'=>$request->quantity, 'import_price' => $request->import_price, 'sell_price' => $request->sell_price]);
        if ($result) {
            return back()->with('success', 'Đã nhập kho thành công!');
        } else {
            return back()->with('error', 'Không ổn dồi, có lỗi xảy ra!');
        }
    }
    public function update(Request $request, $product_id)
    {
        $stock = ProductStock::findOrFail($request->input('id'));
        if ($stock) {
            $stock->quantity=$request->input('quantity');
            $stock->import_price = $request->input('import_price');
            $stock->sell_price = $request->input('sell_price');
            $result = $stock->save();
            if ($result) {
                return back()->with('success', 'Đã lưu thay đổi!');
            }
        }
        return back()->with('error', 'Không ổn dồi, có lỗi xảy ra!');
    }
}
