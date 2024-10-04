<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $today = Carbon::now();
$date = Carbon::parse($this->date);
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'picture' => $this->picture,
            'objectif' => $this->objectif,
            'type' => $this->type,
            'domaine' => $this->domaine,
            'pays' => $this->pays,
            'etat' => $this->etat,
            'commune' => $this->commune,
            'bassin' => $this->bassin,
            'date' => $this->date,
            'lieu' => $this->lieu,
            'user_id' => $this->user_id,
            'state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->user,
            'actors' => $this->actors, // Assuming you have ActorResource for actors
            'completion' => $this->state == 'done' ? 100: 50,
            'actorCount' => $this->actors->count(), // Add the actor count
            'color' => $today->lt($date) ? 'green' : ($today->eq($date) ? 'blue' : 'gray')
        ];
    }
}
