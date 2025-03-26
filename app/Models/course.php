<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'duration', 'level'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag');
    }
}
