<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'barang_id'=>$this->category_id,
            'user_id'=>$this->user_id,
            'barang'=>$this->whenLoaded('barang'),
            'user'=>$this->whenLoaded('user')
        ];
    }
}
