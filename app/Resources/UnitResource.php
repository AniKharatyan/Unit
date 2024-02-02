<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'number' => $this->resource->number,
            'price' => $this->resource->price
        ];
    }
}
