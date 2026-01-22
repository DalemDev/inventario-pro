<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'company_id',
        'purchase_id',
        'product_id',
        'quantity',
        'cost',
        'total',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
