<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRoles extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'role_code',
        'user_id',
        'status',
    ];
    protected $guarded = [];

    public $translatable = [];

    public function users(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
