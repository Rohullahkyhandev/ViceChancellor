<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'dname' => $this->name,
            'tname' => $this->tname,
            'lname' => $this->lname,
            'arank' => $this->arnk,
            'temail' => $this->temail,
            'photo' => $this->photo
        ];
    }
}
