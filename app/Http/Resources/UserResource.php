<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role' => new RoleResource($this->role),
            'name' => $this->name,
            'email' => $this->email,
            'shop_name' => $this->when($this->role->name == 'merchant', $this->shop_name),
            'phone' => $this->phone,
            'address' => $this->address,
            'email_verified_at' => $this->email_verified_at,
            'points' => $this->when($this->role->name == 'customer', new PointResource($this->point)),
            'deleted_at' => (string) $this->deleted_at,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
