<?php

namespace LasseHaslev\LaravelFieldable;

use App\Modules\Ads\FormatImageInfo;
use Illuminate\Database\Eloquent\Model;

class FieldRepresenter extends Model
{

    protected $fillable = [
        'name',
        'identifier',
        'type',
        'description',
        'is_repeatable',
    ];

    /**
     * connect to the template
     *
     * @return App\Modules\Ads\Template
     */
    public function fieldable()
    {
        return $this->morphTo();
    }

    /**
     * Connect to the values
     *
     * @return void
     */
    public function values()
    {
        return $this->hasMany(FieldValue::class);
    }

    public function parent() {
        return $this->belongsTo(static::class);
    }

    public function fields() {
        return $this->hasMany(static::class);
    }

    /**
     * Connect to the image info for this formats
     *
     * @return void
     */
    public function formatImageInfo()
    {
        return $this->hasMany( FormatImageInfo::class );
    }

}
