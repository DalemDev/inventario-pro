<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'company_id',
        'type',
        'title',
        'message',
        'entity_type',
        'entity_id',
        'level',
        'read_at',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function markAsRead()
    {
        $this->read_at = now();
        $this->save();
    }
}
