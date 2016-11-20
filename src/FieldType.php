<?php

namespace LasseHaslev\LaravelFieldable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldType extends Model
{

    use SoftDeletes;

    protected $table = 'field_types';

    protected $dates = [ 'deleted_at' ];

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

    public static function folder( string $relativePath = null )
    {
        $returnValue = resource_path( config( 'fieldable.views.fields' ) );

        if ( $relativePath ) {
            $returnValue .= '/' . $relativePath;
        }

        return $returnValue;
    }

    /**
     * Get full rendered path to view
     *
     * @return string
     */
    public function viewPath()
    {
        return static::folder( $this->view );
    }


}
