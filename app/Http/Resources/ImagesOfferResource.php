<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class ImagesOfferResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
        ];
    }
}
