<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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
    public function analyticType()
    {
        return $this->belongsTo(AnalyticType::class);
    }

    /**
     * Scope a query to only include numeric (or not) property analytics
     *
     * @param Builder $query
     * @param bool    $flag [Optional]
     *
     * @return Builder
     */
    public function scopeIsNumeric(Builder $query, bool $flag = true)
    {
        return $query->whereHas('analyticType', function ($query) use ($flag) {
            $query->where('is_numeric', $flag);
        });
    }

    /**
     * Scope a query to only include property analytics for given area
     *
     * @param string $area suburb|state|country
     * @param string $name
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllPerArea(Builder $query, string $area, string $name)
    {
        return $query->whereHas('property', function ($query) use ($area, $name) {
            $query->where($area, $name);
        });
    }
}
