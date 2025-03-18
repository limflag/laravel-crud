<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'job_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobVacancie()
    {
        return $this->belongsTo(JobVacancie::class);
    }

}
