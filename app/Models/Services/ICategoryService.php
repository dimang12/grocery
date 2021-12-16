<?php
namespace App\Models;

interface ICategoryService
{
    public function getAllCategories();
    public function geCategory(int $categoryId);
    public function addCategory($category);
    public function updateCategory(int $categoryId, Category $category);
    public function deleteCategory(int $categoryId);
}
