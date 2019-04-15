<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
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
            'nick_name' => $this->nick_name,
            'birthday' => $this->birthday,
            'city' => $this->city,
            'email' => $this->email,
            'phone' => $this->phone,
            'education' => $this->education,
            'created_at' => $this->created_at->format('M j, Y'),
            'updated_at' => $this->updated_at->format('M j, Y'),
        ];
    }
}
