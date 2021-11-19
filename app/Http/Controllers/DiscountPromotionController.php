<?php

namespace App\Http\Controllers;

use App\Model\Discount;
use App\Model\DiscountedProduct;
use App\Model\Product;
use DateTime;
use Illuminate\Http\Request;

class DiscountPromotionController extends Controller
{
    //
    protected $discountList;
    protected $typeList;
    public function __construct()
    {
        $this->discountList = Discount::all();
        $this->typeList = ['Phần trăm', 'Số tiền', 'Tặng quà'];
    }
    public function index()
    {
        return view('admin.discount_promotion.index', [
            'discountList' => $this->discountList,
        ]);
    }
    public function createDiscount()
    {
        return view('admin.discount_promotion.discount.create',['typeList'=> $this->typeList]);
    }
    public function storeDiscount(Request $request)
    {
        $request->validate([]);
        $options = $request->all(['title', 'type', 'discounted_rate', 'discounted_amount', 'expired_at', 'content','url']);
        $result = Discount::create($options);
        if ($result) {
            return back()->with('success', 'Đã thêm chương trình khuyến mại!');
        } else {
            return back()->with('error', 'Có lỗi xảy ra!');
        }
    }
    public function editDiscount($id)
    {

        $discount = Discount::findOrFail($id);
        if ($discount) {
            $productList = Product::all('id', 'name', 'sku');

            return view('admin.discount_promotion.discount.edit', ['discount' => $discount, 'productList'=>$productList,'typeList'=>$this->typeList]);
        } else {
            return back()->with('error', 'Không thể truy cập trang!');
        }
    }
    public function updateDiscount(Request $request, $id)
    {
        // dd($request->input(), $id);
        $discount = Discount::findOrFail($id);
        if($discount){
            $options = $request->all('title','type','discounted_rate','discounted_amount','expired_at','content','url');
            if($discount->update($options)){
                return back()->with('success','Đã lưu thay đổi!');
            }
        }

        return back()->with('error','Có lỗi xảy ra!');
    }
    public function addProductsToDiscount(Request $request, $id)
    {
        // dd($request->input(),$id);
        /**
         * TODO
         * Thêm danh sách sản phẩm vào bảng discounted_product => done
         */

        $filtered = array_filter($request->input('products'), function ($product) {
            return isset($product['checked']);
        });
        if (!empty($filtered)) {
            $mapped = array_map(function ($key, $value) use ($id) {
                return ['product' => $key, 'discount' => $id, 'quantity' => $value['quantity'] ?? 0, 'created_at' => new DateTime()];
            }, array_keys($filtered), array_values($filtered));

            DiscountedProduct::where('discount', $id)->forceDelete();
            // dd($mapped);
            if (DiscountedProduct::insert($mapped)) {
                return back()->with('success', 'Đã lưu thay đổi!');
            }


            return back()->with('error', 'Có lỗi xảy ra!');
        }
        return back();
    }
    public function destroyDiscount(Request $request)
    {

    }
}

