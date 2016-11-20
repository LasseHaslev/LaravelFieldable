<?php

namespace LasseHaslev\LaravelFieldable\Observers;

use LasseHaslev\LaravelFieldable\FieldRepresenter;

/**
 * Class FieldRepresenterObserver
 * @author Lasse S. Haslev
 */
class FieldRepresenterObserver
{
    // Creating or saving?
    /**
     * Creating representer
     *
     * @return void
     */
    public function creating($representer)
    {
        if ( isset( $representer->order ) ) return;

        $representer->order = FieldRepresenter::where( 'fieldable_type', $representer->fieldable_type )
            ->where( 'fieldable_id', $representer->fieldable_id )->count();
    }

}
