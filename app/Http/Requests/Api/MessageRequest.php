<?php

namespace App\Http\Requests\Api;

use App\Domains\Auth\Http\Rules\ownerShip;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "body"        => "required|string|max:299",
            "receiver_id" => "required|integer|exists:users,id|not_in:".auth()->user()->id,
        ];
    }

}
