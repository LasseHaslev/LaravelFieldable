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
     * Setup testing
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->fieldType = factory( FieldType::class )->create();
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

    // Have config for checking if groups are allowed
    // Can add a new group on fieldable

    // A group can have representers
    // A normal field can not have any field representers
}
