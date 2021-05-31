<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'isbn' => $this->isbn,
            'titre' => $this->titre,
            'auteur' => $this->auteur,
            'price' => $this->price,
            'discovering_date' => $this->discovering_date
        ];
    }
}
