<?php

namespace LasseHaslev\LaravelFieldable\Traits;

use LasseHaslev\LaravelFieldable\FieldRepresenter;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait Fieldable
 * @author Lasse S. Haslev
 */
trait Fieldable
{
    /**
     * Add new field
     *
     * @return void
     */
    public function addField( $attributes = [] )
    {

        if ( $attributes instanceOf Model && $attributes->isFieldable() ) {
            return $this->fields()->save( $attributes );
        }

        return $this->fields()->create( $attributes );
    }

    /**
     * Get all the fields belongs to this template
     *
     * @return Collection App\Modules\Ads\Format
     */
    public function fields()
    {
        return $this->morphMany(FieldRepresenter::class, 'fieldable');
    }

    /**
     * Check if this field is fieldable
     *
     * @return boolean
     */
    public function isFieldable()
    {
        return true;
    }

    /**
     * Add field and field
     *
     * @return self
     */
    public function addFieldAndValue($field, $value)
    {
        $field = $this->addField( $field );
        $field->addValue( $value )
            ->to( $this )
            ->save();
        return $this;
    }

    /**
     * Save values
     *
     * @return void
     */
    public function saveFieldable( $request )
    {

        if ( ! $request->has( 'fieldable' ) ) {
            return null;
        }

        $data = $request->get( 'fieldable' );

        $this->fields()->create( $data );

    }

}
