<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{


    // public static $wrap = null; // remove data wrapping for this resource only

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'nationality' => $this->nationality,
            'birthdate' => $this->birthdate->format('Y-m-d')
        ];
    }
}
