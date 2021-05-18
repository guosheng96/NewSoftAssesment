<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\ArchivedJobCreated;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded  = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
