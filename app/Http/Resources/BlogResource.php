<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "content" => $this->content,
            "created_at" => $this->created_at,
            'doctor' => $this->doctor ? new DoctorResource($this->doctor) : null,
        ];
    }
}
