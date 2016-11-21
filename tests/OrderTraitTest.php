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

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->objectToBeAddedOn = ObjectToBeAddedOn::create();

        $this->fieldOne = $this->objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $this->fieldTwo = $this->objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $this->fieldThree = $this->objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );

    }

    // Check if we can get all values for this field
    // Can get all values of field and if Valueable object is inseted we filter to that
    // Can change field positiong (Change order)
    /** @test */
    public function is_setting_order_when_creating_new_field_field() {
        // dd( $field );
        // dd( $fieldOne->name );
        $this->assertEquals( 0, $this->fieldOne->order );
        $this->assertEquals( 1, $this->fieldTwo->order );
        $this->assertEquals( 2, $this->fieldThree->order );
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

    }
    /** @test */
    // public function can_change_field_position() {

        // $earlierObject = ObjectToBeAddedOn::create();
        // $earlierObject->addField([
            // 'name'=>'lisjeflijsef',
        // ]);

        // $objectToBeAddedOn = new ObjectToBeAddedOn();
        // $objectToBeAddedOn->save();

        // $field = $objectToBeAddedOn->addField( [
            // 'name'=>'lijsef',
            // 'field_type_id'=>'1',
        // ] );
        // $fieldTwo = $objectToBeAddedOn->addField( [
            // 'name'=>'lijsef',
            // 'field_type_id'=>'1',
        // ] );
        // $fieldThree = $objectToBeAddedOn->addField( [
            // 'name'=>'lijsef',
            // 'field_type_id'=>'1',
        // ] );

        // $fieldOne->moveTo( 2 );

        // $this->assertEquals( 2, $fieldOne->order );
        // $this->assertEquals( 0, $fieldTwo->order );
        // $this->assertEquals( 1, $fieldThree->order );

    // }
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
