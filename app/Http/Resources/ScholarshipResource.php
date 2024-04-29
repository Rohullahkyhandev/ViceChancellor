<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipResource extends JsonResource
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
            'country' => $this->country,
            'edu_degree' => $this->edu_degree,
            'edu_maqta' => $this->edu_maqta,
            'sent_date' => $this->sent_date,
            'back_date' => $this->back_date,
            'document_path' => $this->document_path,
            'teacher_name' => $this->teacher_name,
            'teacher_lname' => $this->teacher_lname,
            'department' => $this->department,
            'faculty' => $this->faculty,
            'uname' => $this->uname,
        ];
    }
}
