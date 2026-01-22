<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'company_id',
        'name'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    protected $table = 'categories';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
