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

    // Check if we have configuration: config( 'fieldable.views.fields' );
    /** @test */
    public function check_if_field_view_configuration_is_set() {
        $this->assertEquals( resource_path( 'views/vendor/fieldable/fields' ), FieldType::folder() );
    }

    /** @test */
    public function check_if_field_type_folder_function_can_have_parameter_for_file() {
        $this->assertEquals( resource_path( 'views/vendor/fieldable/fields/hello' ), FieldType::folder( 'hello' ) );
    }

    /** @test */
    public function can_get_full_view_path_from_model() {

        $fieldType = factory( FieldType::class )->create([ 'view'=>'text.blade.php' ]);

        $this->assertEquals( resource_path( 'views/vendor/fieldable/fields/text.blade.php' ), $fieldType->viewPath() );
    }

    // Check if view already exists in relative path
    // can_add_new_field_type
    // can_edit_new_field_type
    // can_delete_field_type
}
