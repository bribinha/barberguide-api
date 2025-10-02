<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;

    // Um horário de trabalho pertence a um profissional
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
