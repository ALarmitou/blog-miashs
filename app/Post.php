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

    public function posts(){
        return $this->belongsToMany('App\Post','posts_posts','post_post_id','post_file_id');
    }

    public function files(){
        return $this->belongsToMany('App\Post','posts_posts','post_file_id','post_post_id');
    }
}
