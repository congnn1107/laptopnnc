<?php

namespace App\Http\Controllers;

use App\Model\Discount;
use App\Model\DiscountedProduct;
use App\Model\Product;
use App\Model\Promotion;
use App\Model\PromotionProduct;
use DateTime;
use Illuminate\Http\Request;

class DiscountPromotionController extends Controller
{
    //
    protected $discountList;
    protected $promotionList;
    public function __construct()
    {
        $this->discountList = Discount::all();
        $this->promotionList = Promotion::all();
    }
    public function index()
    {
        return view('admin.discount_promotion.index', [
            'discountList' => $this->discountList,
            'promotionList' => $this->promotionList
        ]);
    }
    public function createDiscount()
    {
        return view('admin.discount_promotion.discount.create');
    }
    public function storeDiscount(Request $request)
    {
        $request->validate([]);
        $options = $request->all(['title', 'type', 'discounted_rate', 'discounted_amount', 'expired_at', 'content']);
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

            return view('admin.discount_promotion.discount.edit', compact('discount', 'productList'));
        } else {
            return back()->with('error', 'Không thể truy cập trang!');
        }
    }
    public function updateDiscount(Request $request, $id)
    {
        // dd($request->input(), $id);
        $discount = Discount::findOrFail($id);
        if($discount){
            $options = $request->all('title','type','discounted_rate','discounted_amount','expired_at','content');
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

    //Promotion

    public function createPromotion()
    {
        return view('admin.discount_promotion.promotion.create');
    }
    public function storePromotion(Request $request){
        $request->validate([

        ]);
        $options = $request->all('title','expired_at','content');

        if(Promotion::create($options)){
            return back()->with('success','Đã thêm dữ liệu!');
        }

        return back()->with('error','Có lỗi xảy ra!');
    }

    public function editPromotion($id)
    {

        $promotion = Promotion::findOrFail($id);
        if ($promotion) {
            $productList = Product::all('id', 'name', 'sku');

            return view('admin.discount_promotion.promotion.edit', compact('promotion', 'productList'));
        } else {
            return back()->with('error', 'Không thể truy cập trang!');
        }
    }

    public function updatePromotion(Request $request, $id)
    {
        // dd($request->input(), $id);
        $promotion = Promotion::findOrFail($id);
        if($promotion){
            $options = $request->all('title','expired_at','content');
            if($promotion->update($options)){
                return back()->with('success','Đã lưu thay đổi!');
            }
        }

        return back()->with('error','Có lỗi xảy ra!');
    }

    public function addProductsToPromotion(Request $request, $id)
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
                return ['product' => $key, 'promotion' => $id, 'quantity' => $value['quantity'] ?? 0, 'created_at' => new DateTime()];
            }, array_keys($filtered), array_values($filtered));

            PromotionProduct::where('promotion', $id)->forceDelete();
            // dd($mapped);
            if (PromotionProduct::insert($mapped)) {
                return back()->with('success', 'Đã lưu thay đổi!');
            }


            return back()->with('error', 'Có lỗi xảy ra!');
        }
        return back();
    }
}

