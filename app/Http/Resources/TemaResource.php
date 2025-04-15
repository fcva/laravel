<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '_id'               => $this->_id,
            'nro_tema'          => $this->nro_tema,
            'nombre'            => $this->nombre,
            'definicion'        => $this->definicion,
            'ejemplo_codigo'    => $this->ejemplo_codigo,
        ];
    }
}
