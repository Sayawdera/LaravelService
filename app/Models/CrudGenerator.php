<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudGenerator extends BaseModel
{
    use HasFactory;

    protected $fillable = [];
    protected $hidden = [];
    protected $casts = [];
    public $translatable = [];
}
