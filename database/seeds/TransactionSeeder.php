<?php

use App\Models\Customer;
use App\Models\Owner;
use App\Models\Properties;
use App\Models\Property_type;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();

       for ($i=0;$i<20;$i++){
           DB::table('transactions')->insert([

               'owners_id' => Owner::inRandomOrder()->first()->id,
               'properties_id' => Properties::inRandomOrder()->first()->id,
               'customers_id' => Customer::inRandomOrder()->first()->id,
               'transaction_types_id' => '1',
               'details' => $faker->paragraph(3),
           ]);
       }
    }
}
