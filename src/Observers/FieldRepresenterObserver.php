<?php

namespace LasseHaslev\LaravelFieldable\Observers;

use LasseHaslev\LaravelFieldable\FieldRepresenter;

/**
 * Class FieldRepresenterObserver
 * @author Lasse S. Haslev
 */
class FieldRepresenterObserver
{
    /**
     * Creating representer
     *
     * @return void
     */
    public function creating($representer)
    {

        if ( ! config( 'fieldable.groups' ) && $representer->isGroup() ) {
            abort( 405, 'Groups are is set to not allowed in config. This means field_type_id cannot be set to null.' );
        }

        $representer->order = $representer->getEquals()->count();
        // $representer->getEquals()->moveToBack( $representer );
        // $representer->moveToBack( $representer );
    }
}
