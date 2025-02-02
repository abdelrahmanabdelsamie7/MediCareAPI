<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class PharmacyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'service' => $this->service,
            'phone' => $this->phone,
            'image' => $this->image,
            'address' => $this->address,
            'deliveryOption' => $this->deliveryOption,
            'insurence' => $this->insurence
        ];
    }
}
