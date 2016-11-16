<?php

use LasseHaslev\LaravelFieldable\FieldType;

/**
 * Class FirstTest
 * @author yourname
 */
class FieldTypesTest extends TestCase
{
    /** @test */
    public function can_setup_model_for_testing() {
        $fieldType = factory( FieldType::class )->create();
        $this->assertInstanceOf( FieldType::class, $fieldType );
    }

    /** @test */
    public function can_add_new_field_type() {
        $fieldTypeName = 'fieldTypeName';
        $fieldTypeView = 'fieldTypeView';
        $fieldType = FieldType::add( [
            'name'=>$fieldTypeName,
            'view'=>$fieldTypeView,
        ] );

        $this->assertInstanceOf( FieldType::class, $fieldType );
        $this->assertTrue( $fieldType->exists() );
        $this->assertEquals( $fieldTypeName, $fieldType->name );
        $this->assertEquals( $fieldTypeView, $fieldType->view );
    }

    // Check if view already exists in relative path
    // Check if we have configuration: config( 'fieldable.views.fields' );
    // can_add_new_field_type
    // can_edit_new_field_type
    // can_delete_field_type
}
