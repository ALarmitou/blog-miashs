<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'author' => $this->author->name,
            'post_name' => $this->post_name,
            'post_title' => $this->post_title,
            'post_content' => $this->post_content,
            'post_category'=> $this->post_category,
            'post_type'=>$this->post_type
        ];
    }
}
