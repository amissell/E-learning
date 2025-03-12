<?php

namespace App\Repositories;

use App\Models\tag;

class TagRepository
{
    /**
     * @var Tag
     */

     protected $tag;
     /**
      * @param Tag $Tag
      */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
}
