<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;
use LasseHaslev\LaravelFieldable\Traits\Fieldable;

/**
 * Class
 * @author yourname
 */
// class ObjectToBeAddedOn extends Illuminate\Database\Eloquent\Model
class ObjectToBeAddedOn extends FieldRepresenter
{
    use Fieldable;
}

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

    // Can create field representer on element
    /** @test */
    public function can_add_field_representer_on_element() {
        $objectToBeAddedOn = new ObjectToBeAddedOn();
        $objectToBeAddedOn->save();

        $objectToBeAddedOn->addField([
            'name'=>'Field name',
            'identifier'=>'identifier',
            'description'=>'Description',
            'is_repeatable'=>false,
        ]);

        $this->assertEquals( 1, $objectToBeAddedOn->fields()->count() );
    }

    /** @test */
    public function is_returning_self_when_adding_new_field() {
        $objectToBeAddedOn = new ObjectToBeAddedOn();
        $objectToBeAddedOn->save();

        $returnValue = $objectToBeAddedOn->addField([
            'name'=>'Field name',
            'identifier'=>'identifier',
            'description'=>'Description',
            'is_repeatable'=>false,
        ]);

        $this->assertInstanceOf( ObjectToBeAddedOn::class, $returnValue );
    }
    // Prevnent change of identifier and type when editing
    // Check if we can force edit change and identifier when edit

    // Check if we can get all values for
}
