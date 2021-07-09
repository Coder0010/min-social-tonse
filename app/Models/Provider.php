<?php

namespace App\Models;

use App\Core\Entity;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Provider extends Entity
{
    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'name',
        'provider_id',
        'user_id',
        'avater'
    ];

    /**
     * user Relationship.
     *
     * @return belongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
