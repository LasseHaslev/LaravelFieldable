<?php

namespace LasseHaslev\LaravelFieldable;

use Illuminate\Database\Eloquent\Model;
use LasseHaslev\LaravelFieldable\FieldRepresenter;

class FieldValue extends Model
{

    protected $fillable = [
        'value',
        // 'order',
        'field_representer_id',
    ];

    /**
     * Get the valueable
     *
     * @return void
     */
    public function valueable()
    {
        return $this->morphTo();
    }


    /**
     * Connect to the representer
     *
     * @return void
     */
    public function representer()
    {
        return $this->belongsTo(FieldRepresenter::class, 'field_representer_id');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function setRepresenter( FieldRepresenter $representer )
    {
        $this->field_representer_id = $representer->id;
        return $this;
    }

    /**
     * Wich field should we add value to
     *
     * @return void
     */
    public function to( $valueable )
    {

        if ( ! method_exists( $valueable, 'isValueable' ) ) {
            abort( 405, 'You can only add a value to a class that uses LasseHaslev\LaravelFieldable\Traits\Valueable' );
        }

        $this->valueable()->associate( $valueable );
        return $this;
    }


}
