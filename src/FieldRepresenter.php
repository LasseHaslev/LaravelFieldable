<?php

namespace LasseHaslev\LaravelFieldable;

use App\Modules\Ads\FormatImageInfo;
use Illuminate\Database\Eloquent\Model;
use LasseHaslev\LaravelFieldable\Traits\Fieldable;
use LasseHaslev\LaravelSortable\Traits\Sortable;
use LasseHaslev\LaravelFieldable\Traits\BelongsToFieldType;


class FieldRepresenter extends Model
{

    use Fieldable;
    use Sortable;
    use BelongsToFieldType;

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

    /**
     * Get Field Representer that has the same parent as this
     *
     * @return void
     */
    public function getEquals()
    {
        return static::equals( $this->fieldable_type, $this->fieldable_id );
    }

    /**
     * Query the same parent as this
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeEquals($query, $type, $id)
    {
        return $query->where( 'fieldable_type', $type )
            ->where( 'fieldable_id', $id );
    }

    /**
     * Add new field
     *
     * @return void
     */
    public function addField( array $attributes = [] )
    {
        if ( ! $this->isGroup() ) {
            abort( 405, 'A a field representer can not be fieldable unless it is a group (field_type_id=null)' );
        }
        return $this->fields()->create( $attributes );
    }

    /**
     * Check if field is group
     *
     * @return boolean
     */
    public function isGroup()
    {
        return $this->field_type_id == null;
    }

    /**
     * A set a value
     *
     * @return void
     */
    public function setValue( $value )
    {
        return $this->addValue( $value );
    }

    /**
     * Add new value
     *
     * @return void
     */
    public function addValue( $value )
    {

        if ( $this->is_repeatable ) {
            $valueObject = ( new FieldValue )->setRepresenter( $this );
        }
        else {
            if ( ! $this->values()->count() ) {
                $valueObject = ( new FieldValue )->setRepresenter( $this );
            }
            else {
                $valueObject = $this->values()->first();
            }
        }

        $valueObject->value = $value;

        return $valueObject;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function moveTo($position)
    {
        $this->getEquals()->moveTo( $this, $position );
    }

    /**
     * Move up
     *
     * @return void
     */
    public function moveUp()
    {
        return $this->getEquals()->incrementPosition( $this );
    }

    /**
     * Move up
     *
     * @return void
     */
    public function moveDown()
    {
        return $this->getEquals()->decrementPosition( $this );
    }



}
