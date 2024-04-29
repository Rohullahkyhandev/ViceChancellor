<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherDocumentResource extends JsonResource
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
            'type' => $this->type,
            'description' => $this->description,
            'attachment' => $this->attachment,
            'attachment_path' => $this->attachment_path,
            'uname' => $this->uname,

        ];
    }
}
