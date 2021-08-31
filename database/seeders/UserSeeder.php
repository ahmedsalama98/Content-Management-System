<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker =Factory::create();
    $data =[
        'name'=>'ahmed eissa',
        'username'=>'ahmed98',
        'mobile'=>'12345',
        'email'=>'ahmedeissa2016@gmail.com',
        'password'=>Hash::make('88888888'),
        'status'=>1,
        'email_verified_at'=>Carbon::now(),

    ];
     $admin =   User::create($data);
     $admin->attachRole('super-admin');
     $days = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28',];
     $months = ['01','02','03','04','05','06','07','08',];
     $users =[];


     for($i = 0; $i < 1000; $i++){
        $name = $faker->unique()->name;
        $username = $faker->unique()->userName;
        $email = $faker->unique()->safeEmail();

        // $slug = Str::slug( $username);
        $users[]=[
            'name'=>$name,
            'username'=>$username,
            'mobile'=>'010'.random_int(0,9999).random_int(0,9999),
            'email'=>$email,
            'password'=>Hash::make('88888888'),
            'status'=>1,
            'email_verified_at'=>Carbon::now(),
        ];
     }

     $chukes = array_chunk($users , 500);
     foreach($chukes as $chuk){
      User::insert($chuk);
     }


    $users=  User::whereDoesntHaveRole()->get();

    foreach($users as $user){

        $user->attachRole('user');
    }

    }
}
