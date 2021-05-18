<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns;
use App\Events\ArchivedJobCreated;
use App\Contracts\Likeable;
use App\Contracts\Commentable;

class Post extends Model implements Likeable, Commentable
{
    use SoftDeletes;
    use Concerns\Likeable;
    use Concerns\Commentable;

    protected $dates = ['deleted_at'];
    protected $guarded  = [];
}
