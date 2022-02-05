<?php
namespace App\Models\Services;

interface ICategoryService
{
    public static function getAllCategories();
    public static function getCategory(int $categoryId);
    public static function insertCategory($category);
    public static function updateCategory($categoryId, $category);
    public static function deleteCategory(int $categoryId);
}
