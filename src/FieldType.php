<?php

namespace LasseHaslev\LaravelFieldable;

use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    protected $fillable = [
        'name',
        'view',
    ];

    /**
     * Add new Field
     *
     * @return LasseHaslev\LaravelFieldable\FieldType
     */
    public static function add( array $attributes )
    {
        return static::create( $attributes );
    }

}
