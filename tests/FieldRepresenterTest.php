<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;
use LasseHaslev\LaravelFieldable\Traits\Fieldable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use LasseHaslev\LaravelFieldable\FieldType;

/**
 * Class
 * @author yourname
 */
// class ObjectToBeAddedOn extends Illuminate\Database\Eloquent\Model
class ObjectToBeAddedOn extends FieldType
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

        $field = $objectToBeAddedOn->addField([
            'name'=>'Field name',
            'identifier'=>'identifier',
            'description'=>'Description',
            'is_repeatable'=>false,
        ]);

        $this->assertEquals( 'Field name', $objectToBeAddedOn->fields()->first()->name );
        $this->assertEquals( 1, $objectToBeAddedOn->fields()->count() );
    }

    /** @test */
    public function is_returning_field_when_adding_new_field() {
        $objectToBeAddedOn = new ObjectToBeAddedOn();
        $objectToBeAddedOn->save();

        $returnValue = $objectToBeAddedOn->addField([
            'name'=>'Field name',
            'identifier'=>'identifier',
            'description'=>'Description',
            'is_repeatable'=>false,
        ]);

        $this->assertInstanceOf( FieldRepresenter::class, $returnValue );
    }

    /** @test */
    public function can_update_representer() {
        $representer = factory( FieldRepresenter::class )->create();

        $representer->update( [
            'name'=>'new name',
            'description'=>'new description',
        ] );

        $this->assertEquals( 'new name', $representer->name );
        $this->assertEquals( 'new description', $representer->description );

    }
    // Prevnent change of identifier and type when editing
    /** @test */
    public function prevent_change_of_identifier_when_updating_existing_representer() {
        $this->expectException( HttpException::class );

        $representer = factory( FieldRepresenter::class )->create();

        $representer->update( [ 'identifier'=>'whawhat' ] );
    }
    /** @test */
    public function prevent_change_of_type_id_when_updating_existing_representer() {
        $this->expectException( HttpException::class );

        $representer = factory( FieldRepresenter::class )->create();

        $representer->update( [ 'field_type_id'=>98234 ] );
    }
    // Check if we can force edit change and identifier when edit
    /** @test */
    public function can_force_update_non_changeable_properties() {
        $representer = factory( FieldRepresenter::class )->create();

        $representer->forceUpdate( [
            'name'=>'name',
            'field_type_id'=>999,
        ] );

        $this->assertEquals( 'name', $representer->name );
        $this->assertEquals( '999', $representer->field_type_id );
    }

    /** @test */
    public function can_get_equals() {
        $objectToBeAddedOn = new ObjectToBeAddedOn();
        $objectToBeAddedOn->save();

        $firstField = $objectToBeAddedOn->addField([
            'name'=>'Field name',
            'identifier'=>'identifier',
            'description'=>'Description',
            'is_repeatable'=>false,
        ]);

        $new = new ObjectToBeAddedOn();
        $new->save();

        $field = $new->addField([
            'name'=>'Field name',
            'identifier'=>'identifier',
            'description'=>'Description',
            'is_repeatable'=>false,
        ]);
        $fieldTwo = $new->addField([
            'name'=>'Field name',
            'identifier'=>'identifier',
            'description'=>'Description',
            'is_repeatable'=>false,
        ]);

        $this->assertEquals( 1, FieldRepresenter::equals( $firstField->fieldable_type, $firstField->fieldable_id )->count() );
        $this->assertEquals( 2, $field->getEquals()->count() );
    }
    // Can access values from FieldRepresenter
    // A Representer can have FieldValues

    // Write logic to handle the trait to add/handle FieldValue

    // LATER
    // Can set a minium and maxium value for repeatable

    // Use magic method for get to add
    // $object->addImageField();
    // $object->addTextField();
}
