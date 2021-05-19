<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        return Auth::user()->posts()->with('latestComment')->withCount('likes')->orderBy('id','desc')->paginate(10);
    }

    public function show($id){
        return Post::where('id',$id)->with('comments')->withCount('likes')->first();
    }

    public function create(Request $request)
    {
        $post = Post::create($request->all());
        $post->user()->associate(Auth::user());

        return response()->json($post, 201);
    }

    public function update($id, Request $request){

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        return response()->json(['message'=>'Deleted Successfully'], 200);
    }
}
