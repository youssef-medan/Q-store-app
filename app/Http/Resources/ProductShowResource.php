<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'category'=>$this->category->name,
            'seller'=>$this->user->name,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'images'=>$this->images,
            'comments'=>$this->reviews,


        ];
        // return parent::toArray($request);
    }
}
