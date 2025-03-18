<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancie extends Model
{
    /** @use HasFactory<\Database\Factories\JobVacancieFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'paused'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
