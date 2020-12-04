<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'nric',
        'unit',
    ];

    protected $table = 'visitors';

    use SoftDeletes;

    public function unit()
    {
        return $this->belongsTo('App\Models\Condominium');
    }
}
