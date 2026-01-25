<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'company_id',
        'name',
        'password',
        'first_name',
        'last_name',
        'identification_type_id',
        'identification_number',
        'email',
        'last_login_at',
        'status_id',
        'created_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
