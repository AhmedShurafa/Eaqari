<?php

use App\Models\Apartment;
use App\Models\Owner;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Apartment::class,10)->create();

        $faker=Factory::create();
        for ($i=0;$i<15;$i++){
            DB::table('properties')->insert([
                'owners_id' => Owner::inRandomOrder()->first()->id,
                'areas_id' => rand(1,4),
                'property_types_id' => '2',
                'price' => $faker->numberBetween(20000,50000),
                'size' => $faker->numberBetween(100,200),
                'floor' => $faker->numberBetween(1,10),
                'room_number' => $faker->numberBetween(1,5),
                'bathrooms' =>$faker->numberBetween(1,3),
                'address' => $faker->sentence(10),
                'description' => $faker->sentence(20),
                'image' => $faker->imageUrl(),
                'famous' =>rand(0,1)
            ]);
        }
    }
}
