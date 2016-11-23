<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;
use LasseHaslev\LaravelFieldable\FieldValue;
use LasseHaslev\LaravelFieldable\FieldType;
use LasseHaslev\LaravelFieldable\Traits\Valueable;
use LasseHaslev\LaravelFieldable\Traits\Fieldable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NonValueableClass extends FieldType {};
class FieldableAndValueable extends FieldRepresenter{
    use Valueable, Fieldable;
}
class ValueableClass extends FieldType
{
    use Valueable;
}

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class FieldValueTest extends TestCase
{
    private $value;
    protected $field;
    protected $valueable;
    protected $fieldableAndValueable;


    public function setUp() {
        parent::setUp();
        $this->valueable = ValueableClass::create();
        $this->fieldableAndValueable = FieldableAndValueable::create();
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

    /** @test */
    public function valueable_has_function_to_check_if_it_is_valueable() {
        $this->assertTrue( $this->valueable->isValueable() );
    }

    /** @test */
    public function is_setting_field_to_value_when_running_set_value_to_representer() {
        $value = $this->field->setValue( 1 );
        $this->assertInstanceOf( FieldRepresenter::class, $value->representer );
    }

    /** @test */
    public function is_setting_value_when_running_set_value_to_representer() {
        $value = $this->field->setValue( 1 );
        $this->assertEquals( 1, $value->value );
    }

    /** @test */
    public function can_associate_valueable_to_value() {
        $value = $this->field->setValue( 1 )
            ->to( $this->valueable );
        $this->assertEquals( $this->valueable->id, $value->valueable_id );
        $this->assertEquals( get_class( $this->valueable ), $value->valueable_type );
    }

    /** @test */
    public function can_set_value_to_valueable() {
        $this->field->setValue( 1 )
            ->to( $this->valueable )
            ->save();

        $this->assertEquals( 1, $this->field->values()->count() );
        $this->assertEquals( 1, $this->valueable->values()->count() );
    }

    /** @test */
    public function can_only_set_value_to_valueable() {
        $this->expectException( HttpException::class );

        $nonValueable = NonValueableClass::create();

        $value = $this->field->setValue( 1 )
            ->to( $nonValueable )
            ->save();
    }

    /** @test */
    public function is_adding_value_to_field_representer_parent_if_no_to_funciton_is_provided() {


        $fieldableAndValueable = FieldableAndValueable::create();
        $field = $fieldableAndValueable->addField( [
            'name'=>'name',
            'field_type_id'=>1,
        ] );

        $field->setValue( 1 )
            ->save();

        $parent = $field->fieldable;

        // dd($parent);
        $this->assertEquals( 1, $parent->fields()->count() );
        $this->assertEquals( 1, $parent->values()->count() );
    }

    /** @test */
    public function trow_error_if_adding_a_value_to_field_representer_parent_and_parent_is_not_valueabled_if_no_to_function_is_provided() {
        $this->expectException( HttpException::class );

        $nonValueable = NonValueableClass::create();

        $value = $this->field->setValue( 1 )
            ->save();
    }

    /** @test */
    public function can_add_multiple_values_if_field_representer_is_repeatable() {
        $field = $this->fieldableAndValueable->addField([
            'is_repeatable'=>true,
        ]);
        $field->addValue( 1 )
            ->save();

        $field->addValue( 2 )
            ->save();

        $this->assertEquals( 2, $this->fieldableAndValueable->values()->count() );
    }

    /** @test */
    public function prevent_adding_of_multiple_values_if_repeatable_is_false() {
    }

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
