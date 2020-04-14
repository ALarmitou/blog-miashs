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
        return auth()->user()->can("manage-posts") || auth()->user()->can("create-posts") || $post->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "post_name"=>"required",
            "post_title"=>"required",
            "post_content"=>"required",
            "post_category"=>"required",
            "user_id"=>"required",
            "photos"=>"nullable|string",
            "new_photos"=>"nullable",
            "new_photos.*"=>"image|mimes:jpeg,bmp,png|max:2000"
        ];
        return $rules;
    }
}
