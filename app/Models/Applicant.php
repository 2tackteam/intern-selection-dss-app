<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $full_name Nama Lengkap
 * @property string $birth_place Tempat Lahir
 * @property string $birth_date Tanggal Lahir
 * @property string $gender Jenis Kelamin
 * @property string $address Alamat
 * @property string $phone_number Nomor Telepon
 * @property string|null $identity_number Nomor KTP atau kartu identitas lainnya
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Education> $educations
 * @property-read int|null $educations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Score> $scores
 * @property-read int|null $scores_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereUserId($value)
 * @mixin \Eloquent
 */
class Applicant extends Model
{
    use HasFactory;

    protected $table = 'applicants';

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}
