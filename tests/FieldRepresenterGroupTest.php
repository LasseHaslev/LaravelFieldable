<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;
use LasseHaslev\LaravelFieldable\FieldType;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class FieldRepresenterGroupTest extends TestCase
{
    /**
     * @var mixed
     */
    protected $fieldType;

    /**
     * @var mixed
     */
    protected $objectToBeAddedOn;


    /**
     * Setup testing
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->fieldType = factory( FieldType::class )->create();
        $this->objectToBeAddedOn = ObjectToBeAddedOn::create();
    }


    /** @test */
    public function a_representer_can_be_of_type_group() {
        $field = FieldRepresenter::create();

        $this->assertTrue( $field->isGroup() );
    }

    /** @test */
    public function is_group_returns_false_if_it_is_not_a_group() {
        $field = FieldRepresenter::create(['field_type_id'=>$this->fieldType->id]);
        $this->assertNotTrue( $field->isGroup() );
    }

    /** @test */
    public function a_group_can_have_representers() {
        $group = FieldRepresenter::create();

        $group->addField( [
            'name'=>'hello'
        ] );

        $this->assertEquals( 1, $group->fields()->count() );
    }

    /** @test */
    public function a_field_cannot_have_representers() {
        $this->expectException( HttpException::class );
        $field = FieldRepresenter::create(['field_type_id'=>$this->fieldType->id]);

        $field->addField([
            'name'=>'Hello',
        ]);
    }

    /** @test */
    public function can_add_a_new_group_on_fieldable() {

        $this->objectToBeAddedOn->addField( [
            'field_type'=>null,
        ] );

        $this->assertEquals( 1, $this->objectToBeAddedOn->fields()->count() );
        $this->assertTrue( $this->objectToBeAddedOn->fields()->first()->isGroup() );
    }

    // Have config for checking if groups are allowed

    // We can only add multiple group if repeatable_is true
    // ( Can this be a problem? Linking values )

    // A group can have Group
    /** @test */
    public function a_group_can_add_a_new_group() {
        $group = $this->objectToBeAddedOn->addField( [
            'field_type'=>null,
        ] );

        $newGroup = $group->addField( [
            'field_type'=>null,
        ] );

        $this->assertEquals( 1, $group->fields()->count() );
        $this->assertTrue( $group->fields()->first()->isGroup() );
    }

    // A normal field can not have any field representers
}
