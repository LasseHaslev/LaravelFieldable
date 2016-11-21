<?php

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class OrderTraitTest extends TestCase
{
    // Check if we can get all values for this field
    // Can get all values of field and if Valueable object is inseted we filter to that
    // Can change field positiong (Change order)
    /** @test */
    public function is_setting_order_when_creating_new_field_representer() {
        $objectToBeAddedOn = new ObjectToBeAddedOn();
        $objectToBeAddedOn->save();

        $representer = $objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $representerTwo = $objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $representerThree = $objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );

        // dd( $representer );
        // dd( $representer->name );
        $this->assertEquals( 0, $representer->order );
        $this->assertEquals( 1, $representerTwo->order );
        $this->assertEquals( 2, $representerThree->order );
    }
    /** @test */
    public function is_setting_order_to_only_this_fieldable_so_we_do_not_touch_other_fieldable_types() {
        $earlierObject = ObjectToBeAddedOn::create();
        $earlierObject->addField([
            'name'=>'lisjeflijsef',
        ]);

        $objectToBeAddedOn = new ObjectToBeAddedOn();
        $objectToBeAddedOn->save();

        $representer = $objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $representerTwo = $objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );
        $representerThree = $objectToBeAddedOn->addField( [
            'name'=>'lijsef',
            'field_type_id'=>'1',
        ] );

        // dd( $representer );
        // dd( $representer->name );
        $this->assertEquals( 0, $representer->order );
        $this->assertEquals( 1, $representerTwo->order );
        $this->assertEquals( 2, $representerThree->order );

    }
    /** @test */
    // public function can_change_field_position() {

        // $earlierObject = ObjectToBeAddedOn::create();
        // $earlierObject->addField([
            // 'name'=>'lisjeflijsef',
        // ]);

        // $objectToBeAddedOn = new ObjectToBeAddedOn();
        // $objectToBeAddedOn->save();

        // $representer = $objectToBeAddedOn->addField( [
            // 'name'=>'lijsef',
            // 'field_type_id'=>'1',
        // ] );
        // $representerTwo = $objectToBeAddedOn->addField( [
            // 'name'=>'lijsef',
            // 'field_type_id'=>'1',
        // ] );
        // $representerThree = $objectToBeAddedOn->addField( [
            // 'name'=>'lijsef',
            // 'field_type_id'=>'1',
        // ] );

        // $representer->moveTo( 2 );

        // $this->assertEquals( 2, $representer->order );
        // $this->assertEquals( 0, $representerTwo->order );
        // $this->assertEquals( 1, $representerThree->order );

    // }
    // Can access values from FieldRepresenter
    // A Representer can have FieldValues
    // A representer can be of type group (type_id==null?)
    // A group can have representers
    // A normal field can not have any field representer

    // Write logic to handle the trait to add/handle FieldValue

    // LATER
    // Can set a minium and maxium value for repeatable
    //
    // Use magic method for get to add
    // $object->addImageField();
    // $object->addTextField();
}
