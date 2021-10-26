<?php

namespace App\Http\Controllers;

use App\Model\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bannerList = Banner::all();
        $positions = [1,2,3,4];
        return view('admin.banner.index', compact('bannerList','positions'));
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
        $imagePath = $request->file('image')->store('images/banner', 'public');
        $options = ['status' => $status, 'image' => $imagePath, 'url' => $request->url,'position'=>$request->position];
        if (Banner::create($options)) {
            return back()->with('success', 'Đã lưu!');
        } else {
            return back()->with('error', 'Có lỗi xảy ra!');
        }
    }

    public function changeStatus(Request $request)
    {

        $slide = Banner::findOrFail($request->id);
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
        $banner = Banner::findOrFail($id);
        if ($banner) {
            $options = [
                'url' => $request->url,
                'status' => $request->status ? '1' : 0,
                'position' => $request->position
            ];

            if ($file = $request->file('image')) {
                $path = $file->store('images/banner', 'public');
                Storage::disk('public')->delete($banner->image);
                $options['image'] =  $path;
            }
            if ($banner->update($options)) {
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
        if (Banner::destroy($id)) {
            return back()->with('success', 'Đã xóa Banner');
        } else {
            return back()->with('error', 'Có lỗi!');
        }
    }
}
