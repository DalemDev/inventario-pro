<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'trade_name',
        'company_type_id',
        'legal_type_id',
        'legal_code',
        'email',
        'phone',
        'status_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    protected $table = 'companies';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
