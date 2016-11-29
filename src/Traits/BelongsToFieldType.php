<?php

namespace LasseHaslev\LaravelFieldable\Traits;

use LasseHaslev\LaravelFieldable\FieldType;

/**
 * Trait BelongsToFieldType
 * @author Lasse S. Haslev
 */
trait BelongsToFieldType
{
    /**
     * Connect to LasseHaslev\LaravelFieldable\FieldType
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fieldType()
    {
        return $this->belongsTo( FieldType::class );
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function setFieldType( FieldType $fieldType )
    {
        $this->field_type_id = $fieldType->id;
        return $this;
    }

    /**
     * Get view from view Path of field type
     *
     * @return void
     */
    public function fieldView()
    {
        return $this->fieldType->viewPath();
    }


}
