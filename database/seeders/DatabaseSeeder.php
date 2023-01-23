<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Earrings',
                'description' => 'An earring is a piece of jewelry attached to the ear via a piercing in the earlobe.',
                'category' => 'Gold',
                'images' => serialize(['earrings.jpg']),
                'datetime' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Necklace',
                'description' => 'A necklace is an article of jewellery that is worn around the neck.',
                'category' => 'Silver',
                'images' => serialize(['necklace.jpg']),
                'datetime' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Ring',
                'description' => 'A ring is a round band, usually made of metal, worn as ornamental jewelry.',
                'category' => 'Gold',
                'images' => serialize(['ring.jpg']),
                'datetime' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        DB::table('products')->insert($products);

        \App\Models\User::factory(1)->create();
        // \App\Models\Product::factory(5)->create();        
    }
}
