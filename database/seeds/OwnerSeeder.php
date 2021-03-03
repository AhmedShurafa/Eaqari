<?php

use App\Models\Owner;
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
        factory(Owner::class,10)->create();

//        for ($i=0;$i<20;$i++){
//            DB::table('Owners')->insert([
//                'user_id' => '1',
//                'phone' => '6332145',
//                'phone2' => '598710',
//                'ssn' => '132456489',
//                'evaluate' => rand(0,5),
//                'image' => Str::random(10),
//                'facebook' => Str::random(10),
//                'twitter' => Str::random(10),
//                'instagram' => Str::random(10),
//                'status' => rand(0,5),
//            ]);
//        }
    }
}
