<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_student = Role::where('name', 'student')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        $employee = new User();
        $employee->name = 'Admin';
        $employee->email = 'admin@alawooz.com';
        $employee->password = bcrypt('alawooz');
        $employee->status = '1';
//        $employe->mobile = '9400071734';
        $employee->save();
        $employee->roles()->attach($role_admin);

        $manager = new User();
        $manager->name = 'student';
        $manager->email = 'student@alawooz.com';
        $manager->password = bcrypt('123456');
        $manager->status = '1';
//        $manager->mobile = '7907051150';
        $manager->save();
        $manager->roles()->attach($role_student);
    }
}
