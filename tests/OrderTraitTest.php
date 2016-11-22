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

    protected $fields;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->objectToBeAddedOn = ObjectToBeAddedOn::create();

        $this->fields[] = $this->fieldOne = $this->objectToBeAddedOn->addField( [
            'name'=>'one',
            'field_type_id'=>'1',
        ] );
        $this->fields[] = $this->fieldTwo = $this->objectToBeAddedOn->addField( [
            'name'=>'two',
            'field_type_id'=>'1',
        ] );
        $this->fields[] = $this->fieldThree = $this->objectToBeAddedOn->addField( [
            'name'=>'three',
            'field_type_id'=>'1',
        ] );
        $this->fields[] = $this->fieldFour = $this->objectToBeAddedOn->addField( [
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
    public function can_move_to_position() {

        $this->fieldOne->moveTo( 2 )
            ->save();

        $this->reloadModels();

        // Check
        $this->assertEquals( 2, $this->fieldOne->order );
        $this->assertEquals( 0, $this->fieldTwo->order );
        $this->assertEquals( 1, $this->fieldThree->order );
        $this->assertEquals( 3, $this->fieldFour->order );

        $this->fieldOne->moveTo( 1 )
            ->save();
        $this->reloadModels();

        // Check
        $this->assertEquals( 1, $this->fieldOne->order );
        $this->assertEquals( 0, $this->fieldTwo->order );
        $this->assertEquals( 2, $this->fieldThree->order );
        $this->assertEquals( 3, $this->fieldFour->order );

    }

    /** @test */
    public function can_increase_positon_by_one() {
        $this->fieldOne->moveUp()
            ->save();
        $this->reloadModels();

        // Check
        $this->assertEquals( 1, $this->fieldOne->order );
        $this->assertEquals( 0, $this->fieldTwo->order );
        $this->assertEquals( 2, $this->fieldThree->order );
        $this->assertEquals( 3, $this->fieldFour->order );
    }

    /** @test */
    public function can_decrease_positon_by_one() {
        $this->fieldTwo->moveDown()
            ->save();

        $this->reloadModels();

        // Check
        $this->assertEquals( 1, $this->fieldOne->order );
        $this->assertEquals( 0, $this->fieldTwo->order );
        $this->assertEquals( 2, $this->fieldThree->order );
        $this->assertEquals( 3, $this->fieldFour->order );
    }

    /** @test */
    public function order_cannot_go_below_zero() {
        $this->fieldOne->moveDown()
            ->save();

        $this->reloadModels();
        $this->assertEquals( 0, $this->fieldOne->order );

        $this->fieldTwo->moveTo(-1)
            ->save();

        $this->reloadModels();
        $this->assertEquals( 0, $this->fieldTwo->order );
    }

    /** @test */
    public function order_cannot_go_above_max_numbers() {
        $this->fieldFour->moveUp()
            ->save();

        $this->reloadModels();
        $this->assertEquals( 3, $this->fieldFour->order );

        $this->fieldTwo->moveTo(10)
            ->save();

        $this->reloadModels();
        $this->assertEquals( 0, $this->fieldOne->order );
        $this->assertEquals( 3, $this->fieldTwo->order );
        $this->assertEquals( 1, $this->fieldThree->order );
        $this->assertEquals( 2, $this->fieldFour->order );
    }

    protected function reloadModels() {
        $this->fieldOne = $this->fieldOne->fresh();
        $this->fieldTwo = $this->fieldTwo->fresh();
        $this->fieldThree = $this->fieldThree->fresh();
        $this->fieldFour = $this->fieldFour->fresh();
    }
}
