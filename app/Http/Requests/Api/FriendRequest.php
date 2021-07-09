<?php

namespace App\Http\Requests\Api;

use App\Domains\Auth\Http\Rules\ownerShip;
use Illuminate\Foundation\Http\FormRequest;

class FriendRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "status"      => "required|in:".implode(config("system.status"),','),
            "receiver_id" => "required|integer|exists:users,id|not_in:".auth()->user()->id,
        ];
    }

}
