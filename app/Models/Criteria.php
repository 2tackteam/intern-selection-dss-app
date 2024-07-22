<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
