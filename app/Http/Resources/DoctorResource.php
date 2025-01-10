<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class DoctorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fName' => $this->fName,
            'lName' => $this->lName,
            'title' => $this->title,
            'image' => $this->image,
            'clinics' => ClinicResource::collection($this->whenLoaded('clinics')),
        ];
    }
}
