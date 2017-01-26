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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public static function boot()
    {
        static::saved(function ($valueable) {
            // Check if has valueable
            if (request()->has( 'valueable' )) {
                $valueable->saveValues( request()->get( 'valueable' ) );
            }
        });
        return parent::boot();
    }

    /**
     * undocumented function
     *
     * @return void
     */
    protected function saveValues( $values )
    {
        foreach ($values as $identifier=>$value) {
            $representer = $this->fields()->where( 'identifier', $identifier )->first();

            if ( ! $representer ) {
                abort( 500, sprintf( 'The "%s" identifier is not found on this field', $identifier ) );
            }

            $representer->setValue( $value )->save();
        }
    }


}
