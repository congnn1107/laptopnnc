<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\CPU;
use App\Model\GPU;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Model\ProductCategory;
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

    public function __construct()
    {
        $this->capacity = ["32GB", "64GB", "120GB", "128GB", "240GB", "256GB", "512GB", "1TB", "2TB"];
        $this->screenTypes = ['TN', 'IPS', 'WVA', 'OLED', 'RETINA'];
        $this->screenSizes = ["11.1", "13", "13.5", "14", "15.6", "16", "17", "19", "20", "21"];
        $this->cpuList = CPU::all();
        $this->gpuList = GPU::all();
        $this->categories = Category::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productList = Product::all();
        return view('admin.product.index', ['productList' => $productList]);
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
            'categories' => $this->categories
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
            "memory_slots",
            "memory_type",
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
            "connection_jacks",
            "keyboard",
            "addition",
            "battery",
            "color",
            "operating_system",
            "describe"
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
            'selectedCategories' => $selectedCategories
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
                    "memory_slots",
                    "memory_type",
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
                    "connection_jacks",
                    "keyboard",
                    "addition",
                    "battery",
                    "color",
                    "operating_system",
                    "describe"
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
                Storage::delete($product->card_image);
                if ($path) {
                    $options['card_image'] = $path;
                }
            }
            //xử lý slug
            $options['slug'] = Str::slug($options['name']);

            if($product->update($options)){
                $product->save();
                return back()->with('success','Đã lưu thay đổi!');
            }else{
                return back()->with('error','Có lỗi xảy ra!');
            }

        }else{
            return back()->with("error","Có gì đó bất ổn");
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
    }
}
