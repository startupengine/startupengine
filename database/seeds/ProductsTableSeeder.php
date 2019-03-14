<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan as Artisan;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Artisan::call('command:SyncStripeProducts');
    }
}
