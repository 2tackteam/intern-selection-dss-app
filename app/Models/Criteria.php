<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name Nama Kriteria
 * @property float $weight Bobot Kriteria
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Score> $scores
 * @property-read int|null $scores_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereName($value)
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

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}
