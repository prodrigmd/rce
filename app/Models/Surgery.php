<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'codigoFonasa',
        'area',
        'description',
    ];

    public function template() {
        return $this->hasMany(Action::class, 'surgeries_id')
            ->orderBy('name', 'desc');
    }
}
