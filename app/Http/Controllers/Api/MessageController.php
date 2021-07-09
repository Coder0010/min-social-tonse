<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Api\MessageRequest;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function messageIndex()
    {
        return $this->apiJsonResponse([
            'messages' => MessageResource::collection(auth()->user()->receiverMessages()->latest()->get()),
        ]);
    }

    public function messageStore(MessageRequest $request)
    {
        DB::beginTransaction();
        try {
            auth()->user()->senderMessages()->create([
                "receiver_id" => request("receiver_id"),
                "body"        => request("body"),
            ]);
            DB::commit();
            return $this->apiJsonResponse(
                "message sent sucessfully"
            );
        } catch (Exception $e) {
            DB::rollback();
            return $this->apiJsonResponse($e->getMessage());
        }
    }
}
