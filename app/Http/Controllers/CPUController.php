<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CPURequest;
use App\Model\CPU;

class CPUController extends Controller
{
    protected $brands = ['Intel', 'AMD'];
    protected $series = ['Celeron', 'Pentium', 'Core i3', 'Core i5', 'Core i7', 'Ryzen 3', 'Ryzen 5', 'Ryzen 7'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cpuList = CPU::all();
        $collapsed = "collapsed-box";
        return view('admin.product.cpu.index', ["cpuList" => $cpuList, "brands" => $this->brands, "series" => $this->series, "collapsed" => $collapsed]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cpuList = CPU::all();
        $collapsed = null;
        return view('admin.product.cpu.index', ["cpuList" => $cpuList, "brands" => $this->brands, "series" => $this->series, "collapsed" => $collapsed]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CPURequest $request)
    {
        //
        $cpu = new CPU();
        $cpu->name = $request->name;
        $cpu->series = $request->series;
        $cpu->gen = $request->gen;
        $cpu->cores = $request->cores;
        $cpu->threads = $request->threads;
        $cpu->base_clock = $request->base_clock;
        $cpu->turbo_clock = $request->turbo_clock;
        $cpu->cache = $request->cache;
        $cpu->intergrated_gpu = $request->intergrated_gpu;
        $cpu->release_date = $request->release_date;
        $cpu->brand = $request->brand;
        $result = $cpu->save();
        if ($result) {
            return back()->with("success", "Đã Thêm CPU $request->name!");
        } else {
            return back()->with("error", "Có lỗi xảy ra!");
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
        $cpu = CPU::findOrFail($id);

        return view('admin.product.cpu.update', ['cpu' => $cpu, 'brands' => $this->brands, 'series' => $this->series]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CPURequest $request, $id)
    {
        //
        $cpu = CPU::findOrFail($id);
        if ($cpu) {
            $cpu->name = $request->name;
            $cpu->series = $request->series;
            $cpu->gen = $request->gen;
            $cpu->cores = $request->cores;
            $cpu->threads = $request->threads;
            $cpu->base_clock = $request->base_clock;
            $cpu->turbo_clock = $request->turbo_clock;
            $cpu->cache = $request->cache;
            $cpu->intergrated_gpu = $request->intergrated_gpu;
            $cpu->release_date = $request->release_date;
            $cpu->brand = $request->brand;
            $result = $cpu->save();
            if($result){
                return back()->with("success","Đã lưu!");
            }
        }
        return back()->with("error","Có lỗi xảy ra!");
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
        $result = CPU::destroy($id);
        if ($result) {
            return redirect(route('cpu.index'))->with("success", "Đã xóa!");
        }
    }
}
