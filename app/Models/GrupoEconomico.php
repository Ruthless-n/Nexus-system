<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoEconomico extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'created_by', 'updated_by', 'deleted_by'];

    public function bandeiras()
    {
        return $this->hasMany(Bandeira::class);
    }
}
