<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $role = Role::find($this->role_id);

        // Vérification si le rôle existe
        $roleName = $role ? $role->name : null;
        
        return [
            'id' => $this->id,
            'email' => $this->email,
            'pays' => $this->pays,
            'name' => $this->name,
            'role' => $roleName,
            'photo' => $this->photo,
            'tel' => $this->tel,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
