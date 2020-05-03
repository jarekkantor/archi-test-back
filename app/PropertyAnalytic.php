<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAnalytic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'analytic_type_id', 'value',
    ];

    /**
     * Get the property that the analytic belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the type that the analytic belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(AnalyticType::class);
    }
}
