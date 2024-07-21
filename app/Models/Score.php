<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $application_id
 * @property int $criteria_id
 * @property float $score Skor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant|null $applicant
 * @property-read \App\Models\Criteria $criteria
 * @method static \Illuminate\Database\Eloquent\Builder|Score newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Score newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Score query()
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereCriteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Score extends Model
{
    use HasFactory;

    protected $table = 'scores';

    protected $guarded = ['id'];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
}
