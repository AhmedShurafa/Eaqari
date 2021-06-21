<?php

use App\Userinfo;
use Illuminate\Database\Seeder;

class UserinfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Userinfo::class,10)->create();
    }
}
