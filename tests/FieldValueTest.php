<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;
use LasseHaslev\LaravelFieldable\FieldValue;
use LasseHaslev\LaravelFieldable\FieldType;

class ValueableClass extends FieldType
{
}

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class FieldValueTest extends TestCase
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var mixed
     */
    protected $field;


    public function setUp() {
        parent::setUp();
        $this->value = factory( FieldValue::class )->create();
        $this->field = factory( FieldRepresenter::class )->create();
    }

    /** @test */
    public function can_setup_model_for_testing() {
        $value = factory( FieldValue::class )->create();
        $this->assertInstanceOf( FieldValue::class, $value );
    }

    /** @test */
    public function can_get_field_from_value() {
        $this->assertInstanceOf( FieldRepresenter::class, $this->value->representer );
    }

    /** @test */
    public function can_get_values_from_field() {
        $this->assertEquals( 1, $this->value->representer->values()->count() );
    }

    // Add Valueable trait
    // Check if we can use a value formater to format value
    // This should have a store and get function
    // etc. image.id to image object and image object to image.id
    // Check if we have an interface for that

    // Can add muliple values if repeatable is true
    // Can NOT add muliple values if repeatable is true
    // if multiple values is added to fieldable if is_repeatable is false. Just update value

    // Can update order for values

    // Write logic to handle the trait to add/handle FieldValue

    // LATER
    // FieldValue obay FieldRepresenter minimum and maximum values
}
