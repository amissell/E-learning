<?php

namespace App\Repositories;

use App\Models\tag;
use App\Interface\BaseRepositoryInterface;

class TagRepository implements BaseRepositoryInterface
{
  public function getAll()
  {
      return Tag::all();
  }

  public function getById($id)
  {
      return Tag::find($id); 
  }

  public function create(array $data)
  {
      return Tag::create($data);
  }

  public function update($id, array $data)
  {
      $tag = Tag::find($id);
      $tag->update($data);
      return $tag;
  }

  public function delete($id)
  {
      $tag = Tag::find($id);
      $tag->delete();
      return true;
  }



}