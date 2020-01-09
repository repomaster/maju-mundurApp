<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductMerchantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $merchant = $this->merchants->first();

        return [
            'id' => $this->id,
            'order_code' => $this->order_code,
            'fee' => $this->fee,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'shipping_address' => $this->shipping_address,
            'customer' => new UserResource($this->customer),
            'payment' => new PaymentOptionResource($this->payment_option),
            'products' => ProductResource::collection($merchant->order_products),
            'deleted_at' => (string) $this->deleted_at,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];;
    }
}
