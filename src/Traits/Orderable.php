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

        $this->order = $this->getEquels()->count();
    }

    /**
     * Check if the order has diverged from original order
     *
     * @return boolean
     */
    public function orderDiverged()
    {
        return $this->orderDifference() != 0;
    }

    /**
     * Get the differencial between the original and wanted value
     *
     * @return void
     */
    public function orderDifference()
    {
        return $this->order - $this->getOriginal( 'order' );
    }


    /**
     * Change order
     *
     * @return void
     */
    public function moveTo( int $position )
    {
        $this->order = $position;
        return $this;
    }


}
