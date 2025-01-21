<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use App\Http\Resources\CareCenterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'hospitals' => HospitalResource::collection($this->whenLoaded('hospitals')),
            'care_centers' => CareCenterResource::collection($this->whenLoaded('care_centers')),
            'doctors' => DoctorResource::collection($this->whenLoaded('doctors')),
        ];
    }

}
