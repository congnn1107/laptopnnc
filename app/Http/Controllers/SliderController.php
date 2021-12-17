<?php

namespace App\Http\Controllers;

use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slideList = Slider::all();


        return view('admin.slider.index', compact('slideList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([], []);
        $status = $request->status ? 1 : 0;
        $imagePath = $request->file('image')->store('images/slider', 'public');
    
        $options = ['status' => $status,'position'=>$request->input('position'), 'image' => $imagePath, 'url' => $request->url, 'type' =>  $request->input('type')];
        if (Slider::create($options)) {
            return back()->with('success', 'Đã lưu!');
        } else {
            return back()->with('error', 'Có lỗi xảy ra!');
        }
    }
    public function changeStatus(Request $request)
    {

        $slide = Slider::findOrFail($request->id);
        if ($slide) {
            $slide->status = $request->status;
            $slide->save();

            return response()->json($slide);
        } else {
            return response('Có lỗi xảy ra', 404);
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
        $request->validate([], []);
        $slide = Slider::findOrFail($id);
        if ($slide) {
            $options = [
                'url' => $request->url,
                'status' => $request->status ? '1' : 0
            ];

            if ($file = $request->file('image')) {
                $path = $file->store('images/slider', 'public');
                Storage::disk('public')->delete($slide->image);
                $options['image'] =  $path;
            }
            if ($slide->update($options)) {
                return back()->with('success', 'Đã lưu!');
            }
        }
        return back()->with('error', 'Có lỗi xảy ra!');
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
        $slide = Slider::findOrFail($id);
        Storage::disk('public')->delete($slide->image);
        if (Slider::destroy($id)) {
            return back()->with('success', 'Đã xóa slide');
        } else {
            return back()->with('error', 'Có lỗi!');
        }
    }
}
