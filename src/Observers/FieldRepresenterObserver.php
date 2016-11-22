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

        if ( ! config( 'fieldable.groups' ) && $representer->isGroup() ) {
            abort( 405, 'Groups are is set to not allowed in config. This means field_type_id cannot be set to null.' );
        }

        $representer->moveToBack();
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function saving( $representer )
    {
        if ($representer->exists()) {

            if ( $representer->orderDiverged() ) {

                if ( $representer->orderDifference()  ) {

                    // Is increasing order
                    if ( $representer->orderDifference() > 0 ) {
                        // dd([ $representer->getOriginal( 'order' ), $representer->order ]);
                        $return = $representer->getEquals()->get();
                        $representer->getEquals()
                            ->where( 'order', '>=', $representer->getOriginal('order') )
                            ->where( 'order', '<=', $representer->order )
                            ->decrement('order');
                    }
                    // Is decreasing order
                    else {
                        $representer->getEquals()
                            ->where( 'order', '>=', $representer->order )
                            ->where( 'order', '<=', $representer->getOriginal('order') )
                            ->increment('order');
                    }

                }

            }

        }
    }

}
