<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $_table;
    protected $fillable = ['product_name', 'details'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setProductNameAttr($value)
    {
        # code...
        $this->attributes['product_name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
