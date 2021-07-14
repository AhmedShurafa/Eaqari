<?php

use App\Models\Owner;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Owner::class,10)->create();

        $faker=Factory::create();

       for ($i=0;$i<20;$i++){
           DB::table('Owners')->insert([
               'name' => $faker->name,
               'email' => $faker->email,
               'password' => 'password',
               'phone' => '6332145',
               'phone2' => '598710',
               'ssn' => '132456489',
               'evaluate' => rand(0,5),
               'image' => Str::random(10),
           ]);
       }
    }
}
