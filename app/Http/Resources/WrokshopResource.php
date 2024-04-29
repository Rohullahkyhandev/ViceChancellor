<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WrokshopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'topic' => $this->topic,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'document_path' => $this->document_path,
            'uname' => $this->uname,
        ];
    }
}
