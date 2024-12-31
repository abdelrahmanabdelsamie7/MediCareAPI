<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\ImagesOfferResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'info_about_offer' => $this->info_about_offer,
            'details' => $this->details,
            'price_before_discount' => (float) $this->price_before_discount,
            'discount' => (float) $this->discount,
            'from_day' => $this->from_day,
            'to_day' => $this->to_day,
            'is_active' => $this->is_active,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'images' => $this->whenLoaded('images')
        ];
    }
}
