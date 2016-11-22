<?php

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class OrderTraitTest extends TestCase
{

    protected $objectToBeAddedOn;

    protected $fieldOne;
    protected $fieldTwo;
    protected $fieldThree;
    protected $fieldFour;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->objectToBeAddedOn = ObjectToBeAddedOn::create();

        $this->fieldOne = $this->objectToBeAddedOn->addField( [
            'name'=>'one',
            'field_type_id'=>'1',
        ] );
        $this->fieldTwo = $this->objectToBeAddedOn->addField( [
            'name'=>'two',
            'field_type_id'=>'1',
        ] );
        $this->fieldThree = $this->objectToBeAddedOn->addField( [
            'name'=>'three',
            'field_type_id'=>'1',
        ] );
        $this->fieldFour = $this->objectToBeAddedOn->addField( [
            'name'=>'four',
            'field_type_id'=>'1',
        ] );

    }

    // Check if we can get all values for this field
    // Can get all values of field and if Valueable object is inseted we filter to that
    // Can change field positiong (Change order)
    /** @test */
    public function is_setting_order_when_creating_new_field_field() {
        // dd( $fieldOne->name );
        $this->assertEquals( 0, $this->fieldOne->order );
        $this->assertEquals( 1, $this->fieldTwo->order );
        $this->assertEquals( 2, $this->fieldThree->order );
        $this->assertEquals( 3, $this->fieldFour->order );
    }
    /** @test */
    public function is_setting_order_to_only_this_fieldable_so_we_do_not_touch_other_fieldable_types() {
        $earlierObject = ObjectToBeAddedOn::create();

        $fieldOne = $earlierObject->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $fieldTwo = $earlierObject->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $fieldThree = $earlierObject->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );

        // dd( $fieldOne->name );
        $this->assertEquals( 0, $fieldOne->order );
        $this->assertEquals( 1, $fieldTwo->order );
        $this->assertEquals( 2, $fieldThree->order );
        $this->assertEquals( 3, $this->fieldFour->order );

    }


    /** @test */
    public function can_get_order_diferenceial() {

        $this->fieldTwo->moveTo( 0 );
        $this->assertEquals( -1, $this->fieldTwo->orderDifference() );

        $this->fieldTwo->moveTo( 1 );
        $this->assertEquals( 0, $this->fieldTwo->orderDifference() );

        $this->fieldTwo->moveTo( 2 );
        $this->assertEquals( 1, $this->fieldTwo->orderDifference() );

    }

    /** @test */
    public function can_check_if_the_order_has_diverged_from_original() {

        $this->assertNotTrue( $this->fieldTwo->orderDiverged() );

        $this->fieldTwo->moveTo( 0 );
        $this->assertTrue( $this->fieldTwo->orderDiverged() );

    }
    /** @test */
    public function can_change_field_position() {

        $this->fieldOne->moveTo( 2 )
            ->save();

        $this->assertEquals( 2, $this->fieldOne->order );
        $this->assertEquals( 0, $this->fieldTwo->order );
        $this->assertEquals( 1, $this->fieldThree->order );
        $this->assertEquals( 3, $this->fieldFour->order );

    }
    // Can access values from FieldRepresenter
    // A Representer can have FieldValues
    // A field can be of type group (type_id==null?)
    // A group can have fields
    // A normal field can not have any field field

    // Write logic to handle the trait to add/handle FieldValue

    // LATER
    // Can set a minium and maxium value for repeatable
    //
    // Use magic method for get to add
    // $object->addImageField();
    // $object->addTextField();
}
