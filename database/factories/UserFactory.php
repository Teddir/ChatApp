<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Message;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'avatar' => 'https://via.placeholder.com/150',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' ini crypt, // 123456...ini dri mna tau nya klw 1-6? dari video kayaknya...klw gk gini caranya, bikin baru lagi aj datanya, supaya enak masuk ke akun yg lain.iya mas, gawe lh,data apa?, user ini tadi ane mau login pkai id 2, passnya bkn 1-6, kn gk tau cryptnya ap, jadi bikin baru pakai car yg dibawah ini...jadi bcrypt itu dia merubah mencadi data yg hanya komputer yg bisa baca,tapi ktika kita mau isi password ttp 1-8, pham gk maksud ane..belummm...via wa? suara nya,  iyasnt, vn aja lh.oke 
        'password' => bcrypt('12345678'),
        'remember_token' => Str::random(10),
    ];
});


$factory->define(Message::class, function (Faker $faker) 
{
	do {
	$i = 0;
	$f = 1;
	$t = 10;

	$from = rand($f,$t);
	$to = rand($f,$t);
	$is_read = rand($i, $f);

	} while ($from === $to);


    return [
        'from' => $from,
        'to' => $to,
        'message' => $faker->sentence,
        'is_read' => $is_read
    ];
});