<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Fetch all categories with their subcategories from the repository.
     */
    public function getAllCategoriesWithChildren()
    {
        return $this->categoryRepository->getAllCategoriesWithChildren();
    }

    /**
     * Find a category by its ID.
     */
    public function findCategory($id)
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * Create a new category.
     */
    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * Update a category by its ID.
     */
    public function updateCategory($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    /**
     * Delete a category by its ID.
     */
    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }
}

