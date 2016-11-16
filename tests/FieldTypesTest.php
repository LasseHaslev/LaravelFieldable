<?php

use LasseHaslev\LaravelFieldable\FieldType;

/**
 * Class FirstTest
 * @author yourname
 */
class FieldTypesTest extends TestCase
{
    /** @test */
    public function can_setup_model_for_testing() {
        $fieldType = factory( FieldType::class )->create();
        $this->assertInstanceOf( FieldType::class, $fieldType );
    }
}
