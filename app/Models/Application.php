<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property string $full_name Nama Lengkap
 * @property string $birth_place Tempat Lahir
 * @property \Illuminate\Support\Carbon $birth_date Tanggal Lahir
 * @property string $gender Jenis Kelamin
 * @property string $status Status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Education|null $education
 * @property-read \App\Models\Score|null $score
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\ApplicationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function education(): HasOne
    {
        return $this->hasOne(Education::class);
    }

    public function score(): HasOne
    {
        return $this->hasOne(Score::class);
    }
}
