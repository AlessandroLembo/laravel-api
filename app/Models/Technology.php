<?php

namespace App\Models;

// use Illuminate\Moldels\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color'];

    // Assegno la relazione con i progetti
    public function projects()
    {
        return $this->belongstoMany(Project::class);
    }
}
