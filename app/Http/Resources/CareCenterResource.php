<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CareCenterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'service' => $this->service,
            'address' => $this->address,
            'image' => $this->image,
            'locationUrl' => $this->locationUrl
        ];
    }
}
