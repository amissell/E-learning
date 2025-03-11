<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
  public function children()
  {
    return $this->hasMany(category::class, 'parent_id')->with('children');
  }
}
