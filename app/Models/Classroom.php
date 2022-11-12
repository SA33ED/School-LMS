<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    use HasFactory;
    
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
