<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'title' => $this->title,
            'image' => $this->image,
            'body' => $this->body,
            'created_at' => $this->created_at->format('M j, Y'),
            'updated_at' => $this->updated_at->format('M j, Y'),
        ];
    }

    public function with($request){
        return[
            'version' => '1.0.0',
            'aithor url' => url('https://laravel.com/docs/5.8/eloquent-resources')
        ];
    }
}
