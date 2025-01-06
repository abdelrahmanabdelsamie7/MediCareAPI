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
            'phone' => $this->phone,
            'image' => $this->image,

        ];
    }
}
