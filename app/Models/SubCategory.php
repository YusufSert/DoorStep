<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_name_en',
        'subcategory_name_tr',
        'subcategory_slug_en',
        'subcategory_slug_tr',
    ];

    public function category() {
        return $this->belongsto(Category::class, 'category_id', 'id');
    // Subcategory belognsto (Aittir) Catagory iki sini birleştirdim
    }
}

