<?php

namespace LasseHaslev\LaravelFieldable\Traits;

use LasseHaslev\LaravelFieldable\FieldRepresenter;

/**
 * Trait Orderable
 * @author Lasse S. Haslev
 */
trait Orderable
{

    /**
     * undocumented function
     *
     * @return void
     */
    public function moveToBack()
    {
        if ( isset( $this->order ) ) return;

        $this->order = FieldRepresenter::where( 'fieldable_type', $this->fieldable_type )
            ->where( 'fieldable_id', $this->fieldable_id )->count();
    }


}
