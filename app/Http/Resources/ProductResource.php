<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'merchant' => new UserResource($this->user),
            'name' => $this->name,
            'stock' => $this->stock,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $this->image,
            'deleted_at' => (string) $this->deleted_at,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
