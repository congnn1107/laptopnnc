<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    //

    protected $productsList;

    public function __construct()
    {
        $this->productsList = Product::all();
    }

    public function index()
    {

        return view('admin.product.price.index', ['productsList' => $this->productsList]);
    }

    public function manage($product_id)
    {

        $product = Product::findOrFail($product_id);
        if ($product) {
            return view('admin.product.price.manage', ['product' => $product]);
        } else {
            return back()->with('error', 'Không ổn dồi, có lỗi xảy ra!');
        }
    }
    public function store(Request $request, $product_id)
    {

        //
        $request->validate([], []);

        $result = ProductPrice::create(['product' => $product_id, 'import_price' => $request->import_price, 'sell_price' => $request->sell_price]);
        if ($result) {
            return back()->with('success', 'Đã thêm giá thành công!');
        } else {
            return back()->with('error', 'Không ổn dồi, có lỗi xảy ra!');
        }
    }
    public function update(Request $request, $product_id)
    {
        $price = ProductPrice::findOrFail($request->input('id'));
        if ($price) {
            $price->import_price = $request->input('import_price');
            $price->sell_price = $request->input('sell_price');
            $result = $price->save();
            if ($result) {
                return back()->with('success', 'Đã lưu thay đổi!');
            }
        }
        return back()->with('error', 'Không ổn dồi, có lỗi xảy ra!');
    }
}
