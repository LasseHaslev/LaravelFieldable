<?php

namespace LasseHaslev\LaravelFieldable;

use App\Modules\Ads\FormatImageInfo;
use Illuminate\Database\Eloquent\Model;

class FieldRepresenter extends Model
{

    protected $table = 'field_representers';

    protected $fillable = [
        'name',
        'identifier',
        'type_id',
        'description',
        'order',
        'is_repeatable',
        'field_type_id',
    ];

    /**
     * connect to the template
     *
     * @return App\Modules\Ads\Template
     */
    public function fieldable()
    {
        return $this->morphTo();
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function forceUpdate(array $attributes = [], array $options = [])
    {
        parent::update( $attributes, $options );
    }


    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {

        if (
            ( isset( $attributes[ 'identifier' ] ) && $attributes['identifier'] != $this->identifier ) ||
            ( isset( $attributes[ 'field_type_id' ] ) && $attributes['field_type_id'] != $this->identifier )
        ) {
            abort( 403 );
        }

        return parent::update( $attributes, $options );
    }

    /**
     * Connect to the values
     *
     * @return void
     */
    public function values()
    {
        return $this->hasMany(FieldValue::class);
    }

    public function parent() {
        return $this->belongsTo(static::class);
    }

    public function fields() {
        return $this->hasMany(static::class);
    }

    /**
     * Connect to the image info for this formats
     *
     * @return void
     */
    public function formatImageInfo()
    {
        return $this->hasMany( FormatImageInfo::class );
    }

}
