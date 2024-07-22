<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
