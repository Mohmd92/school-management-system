<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'status'];

    protected $hidden = ['grade_id', 'classroom_id'];

    protected $table = 'sections';
    public $timestamps = true;

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'teachers_sections');
    }
}
