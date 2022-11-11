<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Classroom;
class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    use HasFactory;
    public function classrooms(){
        return $this->hasMany(Classroom::class);
    }
}
