<?php

namespace App\Http\Controllers;

use App\Http\Requests\GPURequest;
use App\Model\CPU;
use App\Model\GPU;
use Illuminate\Http\Request;

class GPUController extends Controller
{
    protected $brandList=['NVIDIA','AMD'];
    protected $seriesList=['GX','MX','GTX','RTX','Quadro','RX'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $GPUList = GPU::all();
        return view('admin.product.gpu.index',['GPUList'=>$GPUList,'brandList'=>$this->brandList,'seriesList'=>$this->seriesList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GPURequest $request)
    {
        //
        $result = GPU::create($request->all('name','series','brand','graph_memory_cap','clock','release_date','addition'));
        if($result){
            return back()->with('success','Đã thêm thông tin GPU!');
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
        $gpu = GPU::findOrFail($id);
        return view('admin.product.gpu.update',['brandList'=>$this->brandList,'seriesList'=>$this->seriesList,'gpu'=>$gpu]);
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
        $gpu = GPU::findOrFail($id);
        if($gpu){
            $result = $gpu->update($request->all('name','series','brand','graph_memory_cap','clock','release_date','addition'));
            if($result){
                return back()->with('success','Đã lưu!');
            }
        }
        return back()->with('error','Có lỗi xảy ra!');



    
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
        $result = GPU::destroy($id);
        if($result){
            return redirect(route('gpu.index'))->with('success','Đã xóa thông tin GPU!');
        }
        return redirect(route('gpu.index'))->with('error','Có lỗi xảy ra!');
    }
}
