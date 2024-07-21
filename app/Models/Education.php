<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property-read \App\Models\Applicant|null $applicant
 * @method static \Illuminate\Database\Eloquent\Builder|Education newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education query()
 * @mixin \Eloquent
 */
class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $guarded = ['id'];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}
