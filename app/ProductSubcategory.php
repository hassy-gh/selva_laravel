<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
