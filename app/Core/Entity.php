<?php

namespace App\Core;

use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

abstract class Entity extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    protected $perPage = 15;

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $casts = [
        "id"       => "int",
        "data"     => "array",
        "sections" => "array",
    ];

    /**
     * This Scope for returning all data with status active
     */
    public function entityFetchData(array $relations = [])
    {
        return $this->with($relations);
    }
}
