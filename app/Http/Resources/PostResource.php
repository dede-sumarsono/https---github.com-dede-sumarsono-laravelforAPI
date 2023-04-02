<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        //$apa = 4 * 4;
        return[
            'id' => $this->id,
            'title' => $this->title,
            //'apa' => $apa,
            'news_content' => $this->news_content,
            //'created_at' => $this -> created_at
            'created_at' => date_format($this->created_at,"Y/m/d H:i:s")
        ];
    }
}
