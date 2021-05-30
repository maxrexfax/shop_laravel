<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'login'                 => 'admin',
            'first_name'            => 'FN_'.Str::random(4),
            'second_name'           => 'SN_'.Str::random(4),
            'last_name'             => 'LN_'.Str::random(4),
            'password'              => Hash::make('123456'),
            'email'                 => 'admin@mail.com',
            'email_verified_at'     => Carbon::now(),
            'remember_token'        => Str::random(10),
            'created_at'            => now()
        ];
        User::create($user);
        for($i = 0; $i < 10; $i++) {
            $user = [
                'login'                 => 'Login_'.Str::random(4),
                'first_name'            => 'FN_'.Str::random(4),
                'second_name'           => 'SN_'.Str::random(4),
                'last_name'             => 'LN_'.Str::random(4),
                'password'              => Hash::make('123456'),
                'email'                 => Str::random(5).'@gmail.com',
                'email_verified_at'     => Carbon::now(),
                'remember_token'        => Str::random(10),
                'created_at'            => now()
            ];
            User::create($user);
        }
    }
}
