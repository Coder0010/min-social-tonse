<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "receiver_id"   => $this->receiver->id,
            "receiver_name" => $this->receiver->name,
            "sender_id"     => $this->sender->id,
            "sender_name"   => $this->sender->name,
            "status"        => $this->status ?? ''
        ];
    }
}
