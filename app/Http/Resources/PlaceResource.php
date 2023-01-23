<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name, 
            'description' => $this->description, 
            'author' => UserResource::make($this->author),
            'city' => $this->city, 
            'score' => $this->score, 
            'review_count' => $this->review_count,
        ];
    }
}
