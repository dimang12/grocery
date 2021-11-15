<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $_table;
    protected $fillable = [
        'product_name',
        'slug',
        'SKU',
        'category_id',
        'price',
        'size',
        'origin',
        'profile',
        'details',
        'our_story',
        'available',
        'available_at',

    ];


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
