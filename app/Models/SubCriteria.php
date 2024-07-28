<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $criteria_id
 * @property string $name Nama Sub Kriteria
 * @property string $weight Bobot Kriteria
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Criteria $criteria
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereCriteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereWeight($value)
 *
 * @property string|null $min_value Nilai Minimum Sub Kriteria
 * @property string|null $max_value Nilai Maximum Sub Kriteria
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCriteria whereMinValue($value)
 *
 * @mixin \Eloquent
 */
class SubCriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_criterias';

    protected $guarded = ['id'];

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
}
