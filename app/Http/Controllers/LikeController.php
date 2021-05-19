<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use Illuminate\Support\Str;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $likeable = $this->likeable($request->likeable,$request->id);
        Auth::user()->addLike($likeable);

        return response()->json([
            'likeable_type' => class_basename($likeable),
            'likeable_id' => $likeable->id,
            'likes' => $likeable->likes()->count()
        ]);
    }

    public function dislike(Request $request)
    {
        $likeable = $this->likeable($request->likeable,$request->id);
        Auth::user()->removeLike($likeable);

        return response()->json([
            'likeable_type' => class_basename($likeable),
            'likeable_id' => $likeable->id,
            'likes' => $likeable->likes()->count()
        ]);
    }

    protected function likeable(String $likeable,Int $id){
        $class = $this->getClass($likeable);
        return $class::findOrFail($id);
    }

    protected function getClass($value): string
    {
        return "App\\Models\\".Str::studly($value);
    }
}
