<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        "user_id",
        "post_title",
        "post_content",
        "post_name",
        "post_category",
        "post_date",
        'post_status',
        'post_type'
    ];

    public function author()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
