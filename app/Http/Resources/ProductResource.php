<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? $this->image : asset('admin/assets/images/brand/coco-cola.jpg'),
            'quantity' => $this->remaining_restaurant_quantity,
            'price' => number_format($this->selling_price, 2),
            'is_cooking' => $this->is_cooking
        ];
    }
}
