<?php

namespace App\Models;

use App\Core\Entity;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Entity
{
    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'body',
        'receiver_id',
        'sender_id',
        'is_readed',
    ];

    /**
     * receiver Relationship.
     *
     * @return BelongsTo
     */
    public function receiver() : BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * sender Relationship.
     *
     * @return BelongsTo
     */
    public function sender() : BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

}
