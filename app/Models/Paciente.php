<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName1',
        'lastName2',
        'dob',
        'sex',
        'rut',
        'email',
        'phone',
        'address',
        'insurance',
        'hospital',
        'diagnosis',
        'status',
        'action_last',
        'action_last_date',
        'action_next',
        'action_next_date',
        'description',
    ];

    public function action() {
        return $this->hasMany(Action::class, 'pacientes_id')
            ->orderBy('date', 'desc');
    }
}
