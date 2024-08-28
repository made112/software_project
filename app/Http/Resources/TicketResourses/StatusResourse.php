<?php

namespace App\Http\Resources\TicketResourses;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StatusResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>      $this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'color' => $this->color,


        ];


    }

}
