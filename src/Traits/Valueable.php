<?php

namespace LasseHaslev\LaravelFieldable\Traits;

use LasseHaslev\LaravelFieldable\FieldValue;

/**
 * Trait Valueable
 * @author Lasse S. Haslev
 */
trait Valueable
{
    /**
     * Check if valueable
     *
     * @return boolean
     */
    public function isValueable()
    {
        return true;
    }

    /**
     * Get all the values belongs to this template
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function values()
    {
        return $this->morphMany(FieldValue::class, 'valueable');
    }

}
