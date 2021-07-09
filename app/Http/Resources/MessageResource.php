<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            "message_id"         => $this->id,
            "message_body"       => $this->body,
            "message_created_at" => Carbon::parse($this->created_at)->format('d/m/Y h:m'),
            "receiver_id"        => $this->receiver->id,
            "receiver_name"      => $this->receiver->name,
            "sender_id"          => $this->sender->id,
            "sender_name"        => $this->sender->name,
            "is_readed"          => $this->is_readed
        ];
    }
}
