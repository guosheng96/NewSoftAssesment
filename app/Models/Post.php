<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns;
use App\Events\ArchivedJobCreated;
use App\Contracts\Likeable;
use App\Contracts\Commentable;
use Auth;

class Post extends Model implements Likeable, Commentable
{
    use SoftDeletes;
    use Concerns\Likeable;
    use Concerns\Commentable;

    protected $dates = ['deleted_at'];
    protected $guarded  = [];

    protected static function booted()
    {
        static::creating(function ($post) {
            $post->user_id = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function latestComment()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'desc')->limit(1);
    }
}
