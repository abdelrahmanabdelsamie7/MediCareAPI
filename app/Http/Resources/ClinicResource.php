<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class ClinicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "address" => $this->address,
            "locationUrl" => $this->locationUrl,
            "phone" => $this->phone,
            'appointments' => DoctorResource::collection($this->whenLoaded('appointments')),
        ];
    }
}
