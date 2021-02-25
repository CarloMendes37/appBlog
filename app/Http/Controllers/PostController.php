<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $data=Post::all();
        return view('backend.post.index', [
            'data'=>$data
        ]);
    }

    public function create()
    {
        $cats=Category::all();
        return view('backend.post.add',['cats'=>$cats]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'detail'=>'required',
        ]);

        //Post Thumbnail
        if ($request->hasFile('post_thumb')) {
            $image1=$request->file('post_thumb');
            $relThumbImage=time().'.'.$image1->getClientOriginalExtension();
            $dest1=public_path('/imgs/thumbs');
            $image1->move($dest1,$relThumbImage);
        }else{
            $relThumbImage='na';
        }

         //Post Full Image
         if ($request->hasFile('post_image')) {
            $image2=$request->file('post_image');
            $relFullImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/full');
            $image2->move($dest2,$relFullImage);
        }else{
            $relFullImage='na';
        }

        $post=new Post();
        $post->user_id=0;
        $post->cat_id=$request->category;
        $post->title=$request->title;
        $post->thumb=$relThumbImage;
        $post->full_img=$relFullImage;
        $post->detail=$request->detail;
        $post->tags=$request->tags;

        $post->save();

        return redirect('admin/post/create')->with('success', 'Dados Criados com Sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cats=Category::all();
        $data=Post::find($id);
        return view('backend.post.update', ['cats'=>$cats, 'data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'detail'=>'required',
        ]);

        //Post Thumbnail
        if ($request->hasFile('post_thumb')) {
            $image1=$request->file('post_thumb');
            $relThumbImage=time().'.'.$image1->getClientOriginalExtension();
            $dest1=public_path('/imgs/thumbs');
            $image1->move($dest1,$relThumbImage);
        }else{
            $relThumbImage=$request->post_thumb;
        }

         //Post Full Image
         if ($request->hasFile('post_image')) {
            $image2=$request->file('post_image');
            $relFullImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/full');
            $image2->move($dest2,$relFullImage);
        }else{
            $relFullImage=$request->post_image;
        }

        $post=Post::find($id);
        $post->cat_id=$request->category;
        $post->title=$request->title;
        $post->thumb=$relThumbImage;
        $post->full_img=$relFullImage;
        $post->detail=$request->detail;
        $post->tags=$request->tags;

        $post->save();

        return redirect('admin/post/'.$id.'/edit')->with('success', 'Dados Actualizado com Sucesso!');
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect('admin/post');
    }
}
