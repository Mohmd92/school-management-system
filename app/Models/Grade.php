<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'notes'];

    protected $table = 'grades';
    public $timestamps = true;

    public function sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'grade_id');
    }
}
