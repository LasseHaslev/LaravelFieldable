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
                        // $representer->getEquals()->where(  )
                    }

                }

            }

        }
    }

}
