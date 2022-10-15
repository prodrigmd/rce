<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'action_type',
        'date',
        'users_id',
        'pacientes_id',
    ];

    public function paciente() {
        return $this->belongsTo(Paciente::class, 'pacientes_id');
    }
}
