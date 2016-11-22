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

        $this->order = $this->getEquals()->count();
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
        $maxCount = $this->getEquals()->count()-1;
        if ( $position <= 0 ) {
            $position = 0;
        }
        if ( $position >= $maxCount ) {
            $position = $maxCount;
        }
        $this->order = $position;
        return $this;
    }

    /**
     * Move position one up
     *
     * @return $this
     */
    public function moveUp()
    {
        $maxCount = $this->getEquals()->count()-1;
        if ( $this->order < $maxCount ) {
            $this->order++;
        }
        return $this;
    }

    /**
     * Move position one up
     *
     * @return $this
     */
    public function moveDown()
    {
        if ( $this->order > 0 ) {
            $this->order--;
        }
        return $this;
    }


}
