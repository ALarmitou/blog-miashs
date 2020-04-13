<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'comment_name' => $this->comment_name,
            'comment_email' => $this->comment_email,
            'comment_content'=> $this->comment_content,
            'comment_date'=>$this->comment_date
        ];
    }
}
