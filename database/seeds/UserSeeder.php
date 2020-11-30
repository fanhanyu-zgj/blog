<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\User::class,20)->create();
        $user=\App\User::find(1);
        $user->name='admin';
        $user->email='wdsj002@126.com';
        $user->password=bcrypt(111111);
        $user->is_admin=TRUE;
        $user->save();

        $user=\App\User::find(2);
        $user->name='guest';
        $user->email='wdsj002@163.com';
        $user->password=bcrypt(111111);
        $user->save();
    }
}
