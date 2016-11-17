<?php

namespace LasseHaslev\LaravelFieldable\Traits;

use LasseHaslev\LaravelFieldable\FieldRepresenter;

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
    public function addField( array $attributes = [] )
    {
        $this->fields()->create( $attributes );
        return $this;
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


}