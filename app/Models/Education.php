<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $applicant_id
 * @property string $education_level
 * @property string $institution_name Nama Instansi / Pendidikan
 * @property string $major Jurusan / Program Studi
 * @property string $start_year Tahun Mulai Ajaran / Pendidikan
 * @property string $end_year Tahun Lulus Ajaran / Pendidikan
 * @property string $gpa IPK atau nilai rata-rata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant $applicant
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Education newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education query()
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereEducationLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereEndYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereGpa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereInstitutionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereStartYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereUpdatedAt($value)
 *
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
