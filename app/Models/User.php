<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Resources\MessageResource;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles ,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * this scope for returning all Users of logged user
     *
     */
    public function scopeallUsersScope(Builder $builder)
    {
        return $builder
        ->where('id','<>', auth()->id())
        ;
    }

    /**
     * this scope for returning all Users of logged user
     *
     */
    public function scopeavailableUsersScope(Builder $builder)
    {
        return $builder
        ->where('id','<>', auth()->id())
        ->doesntHave('senderFriends')
        ;
    }

    /**
     * this scope for returning all Users of logged user
     *
     */
    public function scopeuserFriendsScope(Builder $builder)
    {
        return $builder
        ->where('id','<>', auth()->id())
        ->has('senderFriends')
        ;
    }




    /**
     * messages Relationship.
     *
     * @return HasMany
     */
    public function receiverMessages() : HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * messages Relationship.
     *
     * @return HasMany
     */
    public function senderMessages() : HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Friends Relationship.
     *
     * @return HasMany
     */
    public function receiverFriends() : HasMany
    {
        return $this->hasMany(Friend::class, 'receiver_id');
    }

    /**
     * Friends Relationship.
     *
     * @return HasMany
     */
    public function senderFriends() : HasMany
    {
        return $this->hasMany(Friend::class, 'sender_id');
    }

}
