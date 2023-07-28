<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->nama,
            'description'=>$this->description,
            'image'=>$this->image,
            'price'=>$this->price,
            'category_id'=>$this->category_id,
            'user_id'=>$this->user_id,
            'category'=>$this->whenLoaded('category'),
            'user'=>$this->whenLoaded('user')
        ];
        // return parent::toArray($request);
    }
}
