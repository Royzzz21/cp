<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Profile extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
      return [
         'id' => $this->id,
         'name' => $this->name,
         'email' => $this->email,
         'mobile' => $this->mobile,
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at,
     ];
    }
}
