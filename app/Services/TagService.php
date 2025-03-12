<?php

namespace App\Services;

use App\Interfaces\BaseRepositoryInterface;

class TagService
{
    protected $tagRepository;

    public function __construct(BaseRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function updateTag($id, array $data)
    {
        return $this->tagRepository->update($id, $data);
    }

    public function getTagDetails($id)
    {
        return $this->tagRepository->getById($id);
    }
}
