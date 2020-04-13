<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $post = Post::find($this->route('id'));
        return auth()->user()->can("manage-posts") || $post->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "post_name"=>"required",
            "post_title"=>"required",
            "post_content"=>"required",
            "post_category"=>"required",
            "user_id"=>"required"
        ];
    }
}
