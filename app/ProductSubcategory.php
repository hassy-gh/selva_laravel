<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_category_id',
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
