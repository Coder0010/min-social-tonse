<?php

namespace App\Models;

use App\Core\Entity;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friend extends Entity
{
    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'status',
        'receiver_id',
        'sender_id',
    ];

}
