<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class FieldRepresenterTest extends TestCase
{
    /** @test */
    public function can_setup_model_for_testing() {
        $fieldRepresenter = factory( FieldRepresenter::class )->create();
        $this->assertInstanceOf( FieldRepresenter::class, $fieldRepresenter );
    }
}
