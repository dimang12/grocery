<?php
namespace App\Models\Services;

interface ICategoryService
{
    public static function getAllCategories();
    public static function geCategory(int $categoryId);
    public static function addCategory($category);
    public static function updateCategory($categoryId, $category);
    public static function deleteCategory(int $categoryId);
}
