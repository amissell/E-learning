<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interface\BaseRepositoryInterface;

class CategoryRepository implements BaseRepositoryInterface
{
    /**
     * Get all categories with their subcategories.
     */
    public function all()
    {
        return Category::with('children')->get();
    }

    /**
     * Find a category by its ID.
     */
    public function find($id)
    {
        return Category::with('children')->findOrFail($id);
    }

    /**
     * Create a new category.
     */
    public function create(array $data)
    {
        return Category::create($data);
    }

    /**
     * Update a category by its ID.
     */
    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    /**
     * Delete a category by its ID.
     */
    public function delete($id)
    {
        $category = $this->find($id);
        $category->delete();
        return true;
    }

    /**
     * Get all categories with their subcategories (additional method).
     */
    public function getAllCategoriesWithChildren()
    {
        return $this->all();   
    }
}