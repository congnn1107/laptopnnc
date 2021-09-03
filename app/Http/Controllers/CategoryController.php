<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Model\Category;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $categoriesList;

    function __construct()
    {
        $this->categoriesList = Category::orderBy("parent_id")->get();
    }
    public function index()
    {
        //
        
        return view("admin.categories.index")->with(["categoriesList"=>$this->categoriesList]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view("admin.categories.index")->with(["categoriesList"=>$this->categoriesList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        
        $this->checkValidate($request);

        $category = new Category();
        $category->name= $request->name;
        $category->parent_id = $request->parent;
        $category->slug=Str::slug($request->name);
        try{
            if($category->save()){
                return redirect(route('categories.create'))->with("success","Da luu");
            }
        }
        catch(Exception $e){
            
                // dd($e->getMessage());
                return redirect(route('categories.create'))->with("fail","Co loi xay ra!");
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
        $category = Category::findOrFail($id);
        $categoriesList = Category::where('id',"!=",$id)->get();
        // dd($categoriesList);
        return view("admin.categories.update",['category'=>$category, 'categoriesList'=>$categoriesList]);
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
        $this->checkValidate($request,$id);
        $cate = Category::findOrFail($id);
        if($cate){
            $cate->name=$request->name;
            $cate->slug=Str::slug($request->name);
            $cate->parent_id=$request->parent;
            $result = $cate->save();
            if($result){
                return back()->with("success","Đã lưu!");
            }
        }
        return back()->with("error","Có lỗi xảy ra!");
    }
    private function checkValidate($request , $id=0){

        Validator::make($request->all(),[
            "name"=>["required",Rule::unique("category",'name')->ignore($id)->whereNull('deleted_at')]
        ],
        [
            "name.required" => "Tên danh mục không được bỏ trống!",
            "name.unique" => "Tên danh mục \"$request->name\" đã được sử dụng!"
        ])->validate();
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
        $result = Category::destroy($id);
        if($result){
            return back()->with("deleted_success","Đã xóa danh mục có id =  $id!");
        }
        else{
            return back()->with("deleted_error","Không xóa được!");
        }
    }
}
