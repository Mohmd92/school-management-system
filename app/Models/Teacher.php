<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    //
    use HasTranslations;

    public $translatable = ['name'];

    protected $guarded = [];

    protected $table = 'teachers';

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class,'teachers_sections');
    }
}
