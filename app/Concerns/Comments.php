<?php
namespace App\Concerns;

use App\Contracts\Commentable;
use App\Models\Comment;

trait Comments
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function comment(Commentable $commentable, string $body): self
    {
        $comment = new Comment(['body' => $body]);
        $comment->user()->associate($this)->commentable()->associate($commentable)->save();

        return $this;
    }
}
