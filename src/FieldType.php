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

    public static function Folder( string $relativePath = null )
    {
        $returnValue = resource_path( config( 'fieldable.views.fields' ) );

        if ( $relativePath ) {
            $returnValue .= '/' . $relativePath;
        }

        return $returnValue;
    }


}
