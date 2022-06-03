<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tabungan()
    {
        return $this->hasMany(Saving::class);
    }
}
