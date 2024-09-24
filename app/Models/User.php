<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'cpfcnpj',
        'phone',
        'postal_code',
        'num',
        'address',
        'state',
        'city',
        'role',
        'isento',
        'email',
        'password',
    ];
    
    public function roleLabel() {
        switch ($this->role) {
            case 'client':
                return 'Cliente';
                break;
            case 'admin':
                return 'Administrador';
                break;
            case 'user':
                return 'Colaborador';
                break;
            default:
                return '---';
        }
    }
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
