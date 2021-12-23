<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts =  Post::all();
        return view('admin.post.index',['posts' => $posts,]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.post.create');
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
        // dd($request->input());
        $request->validate([
            'title' => ['required','unique:post,title'],
            'cover_image' => ['nullable','image']
        ],[
            'title.required' => 'Tiêu đề không được bỏ trống!',
            'title.unique' => 'Tiêu đề không được trùng!',
            'cover.image' => ['File không hợp lệ!']
        ]);
        //xử lí hình cover
        
        $options=[
            'title' => $request->input('title'),
            'status' => $request->input('status')?1:0,
            'content' => $request->input('content'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'slug' => Str::slug($request->input('title')),
            'author' => Auth::guard('admin')->user()->id
        ];
        $post = Post::create($options);

        if($post){
            if($request->file('cover_image')){
                $file = $request->file('cover_image')->store('posts/'.$post->id,'public');
               
                $post->cover_image =  $file;
                $post->save();
            }
           
            return redirect()->route('post.index')->with('success','Đã lưu bài viết!');
        }
        else{
            return back()->with('error','Có lỗi xảy ra!')->withInput();
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
        $post = Post::findOrFail($id);
        return view('admin.post.show',['post'=>$post]);
       
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
        $post = Post::findOrFail($id);
        if($post){
            if($post->author==Auth::guard('admin')->user()->id){
                return view('admin.post.update',['post' => $post]);
            }
            else{
                abort(401);
            }
        }
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

        $request->validate([
            'title' => ['required','unique:post,title,'.$id],
            'cover_image' => ['nullable','image']
        ],[
            'title.required' => 'Tiêu đề không được bỏ trống!',
            'title.unique' => 'Tiêu đề không được trùng!',
            'cover.image' => ['File không hợp lệ!']
        ]);
        //xử lí hình cover
        $post = Post::findOrFail($id);
        $oldImage = $post->cover_image;
        $options=[
            'title' => $request->input('title'),
            'status' => $request->input('status')?1:0,
            'content' => $request->input('content'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'slug' => Str::slug($request->input('title')),
            'author' => Auth::guard('admin')->user()->id
        ];

        $result = $post->update($options);

        if($post){
            if($request->file('cover_image')){
                if($oldImage!='') Storage::delete($oldImage);

                $file = $request->file('cover_image')->store('posts/'.$post->id,'public');
               
                $post->cover_image =  $file;
                $post->save();
            }
           
            return redirect()->back()->with('success','Đã lưu bài viết!');
        }
        else{
            return back()->with('error','Có lỗi xảy ra!')->withInput();
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
        if(Post::where('author',Auth::guard('admin')->user()->id)->where('id',$id)->delete()){
            return redirect()->route('post.index')->with('success','Đã xóa bài viết!');
        }else{
            return back()->with('error','Có lỗi xảy ra :3');
        }
    }
}
