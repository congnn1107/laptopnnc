<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\CPU;
use App\Model\GPU;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Model\ProductCategory;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    protected $capacity;
    protected $cpuList;
    protected $gpuList;
    protected $screenTypes;
    protected $screenSizes;
    protected $categories;
    protected $statusList;

    public function __construct()
    {
        $this->capacity = ["32GB", "64GB", "120GB", "128GB", "240GB", "256GB", "512GB", "1TB", "2TB"];
        $this->screenTypes = ['TN', 'IPS', 'WVA', 'OLED', 'RETINA'];
        $this->screenSizes = ["11.1", "13", "13.5", "14", "15.6", "16", "17", "19", "20", "21"];
        $this->cpuList = CPU::all();
        $this->gpuList = GPU::all();
        $this->categories = Category::all();
        $this->statusList= ['Sắp về','Đang kinh doanh','Không kinh doanh'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productList = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.index', ['productList' => $productList]);
    }

    public function updateStock(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->increment('stock',$request->input('stock'));
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.product.create', [
            'capacity' => $this->capacity,
            'cpuList' => $this->cpuList,
            'gpuList' => $this->gpuList,
            'screenTypes' => $this->screenTypes,
            'screenSizes' => $this->screenSizes,
            'categories' => $this->categories,
            'statusList' => $this->statusList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //xử lý danh mục
        // lấy ra các danh mục cha của danh mục đã chọn cho sản phẩm
        $inputList = Category::findMany($request->categories); //objects collection
        $outputList = [];
        $this->makeFullCategories($inputList, $outputList);
        $inputList = array_unique($outputList); //ids array

        //lấy dữ liệu
        $options = $request->all(
            'name',
            'sku',
            "memory",
            "memory_capacity",
            "ssd_storage",
            "ssd_capacity",
            "hdd_storage",
            "hdd_capacity",
            "cpu",
            "gpu",
            "screen_type",
            "screen_size",
            "screen_detail",
            "case_material",
            "bluetooth",
            "wifi",
            "connection_port",
            "keyboard",
            "addition",
            "battery",
            "color",
            "operating_system",
            "describe",
            "size",
            "weight",
            "warranty_time",
            "package",
            "import_price",
            "sell_price",
            "stock",
            "status",
            'webcam'
        );
        //xử lý slug
        $options['slug'] = Str::slug($options['name']);
        $product = Product::create($options);
        //Xử lý upload ảnh
        $file = $request->file('card_image');
        if ($file) {
            $path = $file->store("images/products/$product->id", 'public');
            if ($path) {
                $product->card_image = $path;
                $product->save();
            }
        }
        //xử lý thêm danh mục
        $data = array_map(function ($item) use ($product) {
            return ['product' => $product->id, 'category' => $item];
        }, $inputList);
        ProductCategory::insert($data);

        return redirect(route('product.index'));
    }
    /**
     * Lấy thêm các danh mục cha dựa vào các danh mục người dùng nhập vào cho sản phẩm
     * @param mixed $inputList Danh sách các danh mục
     * @param array &$outputList mảng id các danh mục kết quả
     * @return void
     */
    private function makeFullCategories($inputList, &$outputList)
    {
        foreach ($inputList as $category) {
            $outputList[] = $category->id;
            if ($category->parent()->count() > 0) {
                $this->makeFullCategories($category->parent()->get(), $outputList);
            }
        }
    }

    private function getSelectedCategoryIDs($inputList, &$outputList)
    {
        foreach ($inputList as $category) {
            $outputList[] = $category->id;
        }
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
        $product = Product::findOrFail($id);
        $selectedCategories = [];
        $this->getSelectedCategoryIDs($product->categories, $selectedCategories);
     
        return view("admin.product.update", [
            "product" => $product,
            'capacity' => $this->capacity,
            'cpuList' => $this->cpuList,
            'gpuList' => $this->gpuList,
            'screenTypes' => $this->screenTypes,
            'screenSizes' => $this->screenSizes,
            'categories' => $this->categories,
            'selectedCategories' => $selectedCategories,
            'statusList' =>$this->statusList
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        if ($product) {
            $options = $request->all(
                [
                    'name',
                    'sku',
                    "memory",
                    "memory_capacity",
                    "ssd_storage",
                    "ssd_capacity",
                    "hdd_storage",
                    "hdd_capacity",
                    "cpu",
                    "gpu",
                    "screen_type",
                    "screen_size",
                    "screen_detail",
                    "case_material",
                    "bluetooth",
                    "wifi",
                    "connection_port",
                    "keyboard",
                    "addition",
                    "battery",
                    "color",
                    "operating_system",
                    "describe",
                    "size",
                    "weight",
                    "warranty_time",
                    "package",
                    "import_price",
                    "sell_price",
                    "stock",
                    "status",
                    'webcam'
                ]
            );
            //lấy categories
            $inputList = Category::findMany($request->categories); //objects collection
            $outputList = [];
            $this->makeFullCategories($inputList, $outputList);
            $inputList = array_unique($outputList); //ids array

            //cập nhật file
            $file = $request->file('card_image');
            if ($file) {
                $path = $file->store("images/products/$product->id", 'public');
                Storage::disk('public')->delete($product->card_image);
                if ($path) {
                    $options['card_image'] = $path;
                }
            }
            //xử lý slug
            $options['slug'] = Str::slug($options['name']);

            if ($product->update($options)) {
                $product->save();
                $data = array_map(function ($item) use ($product) {
                    return ['product' => $product->id, 'category' => $item];
                }, $inputList);
                ProductCategory::where('product',$id)->delete();
                ProductCategory::insert($data);
                return back()->with('success', 'Đã lưu thay đổi!');
            } else {
                return back()->with('error', 'Có lỗi xảy ra!');
            }
        } else {
            return back()->with("error", "Có gì đó bất ổn");
        }
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
        $result = Product::destroy($id);
        if ($result) {
            return back()->with('success', "Đã xóa sản phẩm $id!");
        } else {
            return back()->with('error', 'Không ổn dồi, có lỗi xảy ra!');
        }
    }

    //trang shop
    //shopping cart
    public function addToCart($id)
    {
        // Cart::destroy();
        $product = Product::with(['discount'])->findOrFail($id);
        
        
        $items = Cart::search(function ($item, $rowId) use ($id) {
            return $item->id == $id;
        });
        //xử lý lưu trữ khuyến mãi
        $discounts = $product->discount;
        $discounted = 0;
        foreach ($discounts as $discount) {
            if ($discount->type == 0) {
                $discounted += $product->sell_price * $discount->discounted_rate * 0.01;
            } else if($discount->type==1) {
                $discounted += $discount->discounted_amount;
            }
        }
        $cartItemData = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->sell_price,
            'weight' => 1,
            'options' => [
                'image' => asset('storage/' . $product->card_image),
                'product_url' => route('shop.product.show', $product->slug),
                'display_price' => number_format($product->sell_price),
                'discount' => $discounted
            ]
        ];
        $item = Cart::add($cartItemData);
        //nếu số lượng vượt quá trong kho
        if($item->qty>$product->stock){
            $item->qty--;
            return response()->json(['error'=>'Không thể thêm số lượng vì kho không còn đủ!']);
        }
        if (count($items) > 0)
            return response()->json([
                'type' => 'update',
                'item' => $item,
                'total_items' => Cart::count(),
                '_token' => csrf_token(),
                'remove_link' => route('shop.product.removecart', $item->rowId)
            ]);
        return response()->json([
            'type' => 'create',
            'item' => $item,
            'total_items' => Cart::count(),
            '_token' => csrf_token(),
            'remove_link' => route('shop.product.removecart', $item->rowId)
        ]);
    }

    public function updateQuantityCartItem(Request $request)
    {
        try {
            $row = Cart::get($request->rowId);
            if($row->qty >= Product::find($row->id)->stock){
                return response()->json(['error'=>'Không thể thêm số lượng vì kho không còn đủ!']);
            }
            $result = Cart::update($request->rowId, $request->qty);
            //nếu số lượng vượt quá trong kho
       
            return response()->json(['type' => 'update', 'total_items' => Cart::count()]);
        } catch (Exception $e) {
            return response('Item not found!', 404);
        }
    }
    public function removeCartItem($id)
    {
        try {
            $result =  Cart::remove($id);
            return response()->json([
                'type' => 'delete',
                'success' => true,
                'total_items' => Cart::count(),
                'result' => $result
            ]);
        } catch (Exception $e) {
            return response('Item not found', 404);
        }
    }
}
