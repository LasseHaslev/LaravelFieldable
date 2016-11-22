<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class FieldRepresenterGroupTest extends TestCase
{
    /** @test */
    public function a_representer_can_be_of_type_group() {
        $field = FieldRepresenter::create();

        $this->assertTrue( $field->isGroup() );
    }

    /** @test */
    public function is_group_returns_false_if_it_is_not_a_group() {
        $field = FieldRepresenter::create([
            'field_type_id'=>1
        ]);
        $this->assertNotTrue( $field->isGroup() );
    }
    // A representer can be of type group (type_id==null?)
    // A group can have representers
    // A normal field can not have any field representers
}
