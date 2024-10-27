<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes() : HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user = null)
    {
        if ($user === null) {
            return false;
        }

        return $this->likes->contains('user_id', $user->id);
    }

}
