<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function productSubcategories()
    {
        return $this->hasMany(ProductSubcategory::class);
    }
}
