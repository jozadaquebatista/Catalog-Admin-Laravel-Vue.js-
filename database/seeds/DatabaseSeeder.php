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
            'name' => 'Seara Fiari',
            'email' => 'admin@mail.com',
            'password' => bcrypt('456789'),
            'admin' => true
        ]);

        User::create([
            'name' => 'Mara Paipa',
            'email' => 'user@mail.com',
            'password' => bcrypt('456789'),
            'admin' => false
        ]);

        $loop = 0;
        $loopid = 1;

        $start = microtime(TRUE);

        DB::insert('PRAGMA synchronous = OFF');
        DB::insert('PRAGMA temp_store = MEMORY');
        DB::insert('PRAGMA journal_mode = MEMORY');

        DB::beginTransaction();

        while($loop++ < 10000)
        {
            DB::insert('insert into products(name, status) values(?,?)',['Produto ' . $loop, 0]);
            DB::insert('insert into pictures(title, product_id) values(?,?)',[md5(uniqid(rand(), true)) . '.png', $loopid]);

            $loopid++;          
        }

        DB::commit();

        $end = microtime(TRUE);
        echo "Termino do processo de seed em " . ($end - $start) . " segundos.";
    }
}
