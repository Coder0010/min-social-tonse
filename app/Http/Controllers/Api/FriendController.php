<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FriendRequest;

class FriendController extends Controller
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

    public function allUsers()
    {
        return $this->apiJsonResponse([
            'allUsers' => auth()->user()->allUsersScope()->get(),
        ]);
    }

    public function availableUsers()
    {
        return $this->apiJsonResponse([
            'availableUsers' => auth()->user()->availableUsersScope()->get(),
            // 'availableUsers' => User::select(["users.id", "users.name", "friends.status", ])
            //                     ->leftjoin("friends", "friends.receiver_id", "=", "users.id")
            //                     ->where("users.id", "<>", auth()->user()->id )
            //                     ->get()
        ]);
    }

    public function userFriends()
    {
        return $this->apiJsonResponse([
            'userFriends' => auth()->user()->userFriendsScope()->get(),
            // 'userFriends' => User::select(["users.id", "users.name", "friends.status", ])
            //         ->rightjoin("friends", "friends.receiver_id", "=", "users.id")
            //         ->where("users.id", "<>", auth()->user()->id )
            //     ->get()
        ]);
    }

    public function friendStore(FriendRequest $request)
    {
        DB::beginTransaction();
        try {
            auth()->user()->senderFriends()->create([
                "receiver_id" => request("receiver_id"),
                "status"      => request("status"),
            ]);
            DB::commit();
            return $this->apiJsonResponse(
                "friend sent sucessfully"
            );
        } catch (Exception $e) {
            DB::rollback();
            return $this->apiJsonResponse($e->getMessage());
        }
    }
}
