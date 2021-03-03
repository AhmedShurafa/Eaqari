<?php

use App\Models\Apartment;
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
        factory(Apartment::class,10)->create();
    }
}
