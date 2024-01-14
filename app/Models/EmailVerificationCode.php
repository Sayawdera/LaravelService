<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerificationCode extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
    ];
    protected $hidden = [];
    protected $casts = [];
    public $translatable = [];
}
