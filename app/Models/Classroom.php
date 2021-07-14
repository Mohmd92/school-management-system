<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'grade_id'];

    protected $hidden = ['grade_id'];

    protected $table = 'classrooms';
    public $timestamps = true;

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'classroom_id');
    }
}
