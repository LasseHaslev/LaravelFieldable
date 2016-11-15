<?php

namespace LasseHaslev\LaravelFieldable;

use Illuminate\Database\Eloquent\Model;

class FieldValue extends Model
{

    protected $fillable = [
        'value',
        // 'order',
        'field_representer_id',
    ];

    /**
     * Get the fieldable
     *
     * @return void
     */
    public function fieldable()
    {
        return $this->morphTo();
    }


    /**
     * Connect to the representer
     *
     * @return void
     */
    public function representer()
    {
        return $this->belongsTo(FieldRepresenter::class, 'field_representer_id');
    }
}
