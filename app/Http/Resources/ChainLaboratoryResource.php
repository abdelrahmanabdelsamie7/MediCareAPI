<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use App\Http\Resources\LaboratoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChainLaboratoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'laboratories' => LaboratoryResource::collection($this->whenLoaded('laboratories')),
        ];
    }
}
