<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    //
    protected $productsList;
    function __construct()
    {
        $this->productsList = Product::all();
    }
    public function index()
    {
        return view('admin.product.images.index', [
            "productsList" => $this->productsList
        ]);
    }
    public function images($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.images.show', ['product' => $product]);
    }

    public function store(Request $request, $id)
    {
        $request->validate(
            [
                'images.*' => 'image|mimes:jpg,jpeg,png,gif,svg'
            ],
            [
                'images.*.image' => 'Ảnh không hợp lệ!'
            ]
        );

        if (empty($request->file('images'))) return back();

        $product = Product::findOrFail($id);

        if ($product) {
            $images = $request->file('images');
            $image_paths = [];

            foreach ($images as $image) {
                $image_paths[] = $image->store("images/products/$id", 'public');
            }

            $image_paths = array_map(
                function ($image_path) use ($id) {
                    return ['product' => $id, 'image_path' => $image_path];
                },
                $image_paths
            );

            $result = ProductImage::insert($image_paths);
            if ($result) {
                return back();
            }
        }
        return back();
    }
    public function destroy(Request $request,$product_id){
        
        /**
         * Todo:
         * - Xóa ảnh trong storage
         * - Xóa record trong database
         * - return back
         */
        $image = ProductImage::findOrFail($request->id);
        if($image){
            $result = Storage::disk('public')->delete($image->image_path);
        }
        $result = ProductImage::destroy($request->input('id'));
        if($result){
        return back()->with('success','Đã xóa ảnh!');
        }else{
            return back()->with('error','Không ổn dồi, có lỗi xảy ra!');
        }
    }
}
