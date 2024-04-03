<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => '一郎','mail' => 'ichiro@gmail.com','password' => bcrypt('123')],
            ['username' => '二郎','mail' => 'jiro@gmail.com','password' => bcrypt('456')],
            ['username' => '三郎','mail' => 'saburo@gmail.com','password' => bcrypt('789')],
            ['username' => '四郎','mail' => 'shiro@gmail.com','password' => bcrypt('abc')],
            ['username' => '五郎','mail' => 'goro@gmail.com','password' => bcrypt('def')],
            ]);
    }
}
