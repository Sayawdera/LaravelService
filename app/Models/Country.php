<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'country_info',
        'parent_id',
    ];

    protected $hidden = [];
    protected $casts = [];
    public $translatable = ['country_info'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function regions(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function scopeFilter(string $query, array $data): void
    {
        if (isset($data['country']))
        {
            $query->whereNull('parent_id');
        }

        if (isset($data['region']))
        {
            $query->whereNotNull('parent_id')->with('country');
        }
    }
}
