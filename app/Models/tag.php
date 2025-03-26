<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    // protected $table = 'tags';
    protected $fillable = ['name'];



    public function courses(){
      return $this->belongsToMany(course::class, 'course_tag');
    }
}
