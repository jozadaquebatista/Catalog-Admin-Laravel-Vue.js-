<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Picture;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Senhor Kaioh',
            'email' => 'admin@dbzmail.com',
            'password' => bcrypt('456789'),
            'admin' => true
        ]);

        User::create([
            'name' => 'Son Goku',
            'email' => 'user@dbzmail.com',
            'password' => bcrypt('456789'),
            'admin' => false
        ]);

        $loop = 0;

        while($loop++ < 25)
        {
            $id = Product::updateOrCreate([
                'name' => 'Produto 0' . $loop,
                'status' => 0
                /*
                'description' => 'Descrição do Produto 02',
                'price' => 19.99,
                'status' => 1,
                'category' => 1
                */
            ])->id;

            Picture::create(['title' => time() . '.png', 'product_id' => $id]);
        }
    }
}
