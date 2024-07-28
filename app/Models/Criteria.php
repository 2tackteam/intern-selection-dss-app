<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name Nama Kriteria
 * @property string $weight Bobot Kriteria
 * @property string $type Type Kriteria
 * @property string $relation_attribute Atribut Relasi - Kriteria
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubCriteria> $subCriterias
 * @property-read int|null $sub_criterias_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereRelationAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereWeight($value)
 *
 * @mixin \Eloquent
 */
class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criterias';

    protected $guarded = ['id'];

    public function subCriterias(): HasMany
    {
        return $this->hasMany(SubCriteria::class);
    }
}
