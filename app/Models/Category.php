<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
            'category_name',
            "cate_detail",
            "parent_id",
            "left",
            "right",
            "level",
            "update_at",
            "cate_ordering"
        ];
    protected $guarded = [];


    public function getProducts()
    {
        return $this->hasMany(Product::class);
        // return $this->hasMany('App/Product');
    }
}
