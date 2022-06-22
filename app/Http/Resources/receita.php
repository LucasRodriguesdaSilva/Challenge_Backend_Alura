<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class receita extends JsonResource
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
            'valor' => $this->valor,
            'descricao' => $this->descricao,
            'data' => $this->data,
        ];
    }
}
