<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class LaboratoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'phone' => $this->phone,
            'image' => $this->image,
            'city' => $this->city,
            'area' => $this->area,
            'insurence' => $this->insurence
        ];
    }
}
