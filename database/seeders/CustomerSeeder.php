<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("customers")->truncate();
        DB::table("dtrans")->truncate();
        DB::table("htrans")->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Customer::factory()->count(10)->create();
    }
}
