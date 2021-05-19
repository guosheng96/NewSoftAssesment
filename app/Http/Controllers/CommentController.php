<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $commentable = $this->commentable($request->commentable,$request->id);
        Auth::user()->comment($commentable,$request->body);

        return response()->json([
            'commentable_type' => class_basename($commentable),
            'commentable_id' => $commentable->id,
            'body'=>$request->body
        ]);
    }

    protected function commentable(String $commentable,Int $id){
        $class = $this->getClass($commentable);
        return $class::findOrFail($id);
    }

    protected function getClass($value): string
    {
        return "App\\Models\\".Str::studly($value);
    }
}
