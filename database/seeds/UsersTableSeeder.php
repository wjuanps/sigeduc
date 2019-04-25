<?php

use Illuminate\Database\Seeder;
use App\User;

/**
 * 
 * @author Juan Soares
 */
class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::create([
            'name'      => 'Juan Soares',
            'email'     => 'wjuan.ps@gmail.com',
            'password'  => bcrypt('123456')
        ]);
    }
}
