<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'add' => $this->add === 1 ? true : false,
            'edit' => $this->edit === 1 ? true : false,
            'remove' => $this->remove === 1 ? true : false,
            'setting' => $this->setting === 1 ? true : false,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
