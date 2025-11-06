<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'cpf', 'unidade_id', 'created_by', 'updated_by', 'deleted_by'];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }   
}
