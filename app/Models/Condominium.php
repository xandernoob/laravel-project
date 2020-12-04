<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominium extends Model
{
    protected $fillable = [
        'unit',
        'owner',
        'contact'
    ];

    protected $table = 'condominiums';

    public function visitors()
    {
        return $this->hasMany('App\Models\Visitor');
    }

    use HasFactory;
}
