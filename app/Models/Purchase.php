<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'company_id',
        'provider_id',
        'user_id',
        'number',
        'status',
        'subtotal',
        'tax',
        'total',
        'notes',
        'confirmed_at'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
