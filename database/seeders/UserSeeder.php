<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    public function run(): void {
        User::create([
            'name'              => 'BSM INFORMÁTICA',
            'email'             => 'bsm@bsminformatica.com',
            'cpfcnpj'           => '00000000000',
            'phone'             => '84998952050',
            'role'              => 'admin',
            'password'          => Hash::make('123456'),
            'email_verified_at' => now(),
        ]);
    }
}
