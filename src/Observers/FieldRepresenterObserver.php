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
        // dd( $representer );
    }


}
