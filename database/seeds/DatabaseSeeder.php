<?php

use App\Category;
use App\Discussion;
use App\Freebook;
use App\Paidbook;
use App\Transaction;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class,20)->create();
        factory(Category::class,20)->create();
        factory(Freebook::class,20)->create();
        factory(Paidbook::class,20)->create();
        factory(Discussion::class,20)->create();
        factory(Transaction::class,15)->create();

    }
}
