<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Product extends Model
{
    protected $fillable = [
        'company_id',
        'category_id',
        'name',
        'sku',
        'description',
        'minimum_stock'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'product_provider')
            ->withPivot(['cost', 'is_default'])
            ->withTimestamps();
    }

    public function scopeWithCurrentStock($query)
    {
        return $query->addSelect([
            'current_stock' => Movement::select('stock_after')
                ->whereColumn('product_id', 'products.id')
                ->latest('created_at')
                ->limit(1)
        ]);
    }

    public function scopeLowStock($query)
    {
        return $query->fromSub(
            $this->withCurrentStock(),
            'products'
        )->whereColumn('current_stock', '<=', 'minimum_stock');
    }
}
