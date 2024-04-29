<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'source' => $this->source,
            'number' => $this->number,
            'destination' => $this->destination,
            'remark' => $this->remark,
            'date' => $this->date,
            'document_type' => $this->type,
            'attachment' => $this->attachment
        ];
    }
}
