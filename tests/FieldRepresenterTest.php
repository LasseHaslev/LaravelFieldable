<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;
use LasseHaslev\LaravelFieldable\Traits\Fieldable;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    // Check if we can get all values for
}
