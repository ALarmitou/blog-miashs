<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = [
        "post_id",
        "comment_name",
        "comment_email",
        "comment_content",
        "comment_date"
    ];

    public function post(){
        return $this->belongsTo('App\Post','post_id');
    }
}
