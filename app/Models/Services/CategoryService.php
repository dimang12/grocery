<?php
namespace App\Models\Services;

use App\Models\Category;

class CategoryService implements ICategoryService
{

    /**
     * @return mixed
     */
    public static function getAllCategories()
    {
        // TODO: Implement getAllCategories() method.
    }

    /**
     * @param int $categoryId
     * @return mixed
     */
    public static function geCategory(int $categoryId)
    {
        // TODO: Implement geCategory() method.
    }

    /**
     * @param $category
     * @return mixed
     */
    public static function addCategory($category)
    {
        // TODO: Implement addCategory() method.
    }

    /**
     * @param int $categoryId
     * @param Category $category
     * @return mixed
     */
    public static function updateCategory($categoryId, $category)
    {
        Category::where('id', $categoryId)->update($category);
    }

    /**
     * @param int $categoryId
     * @return mixed
     */
    public static function deleteCategory(int $categoryId)
    {
        // TODO: Implement deleteCategory() method.
    }
}
