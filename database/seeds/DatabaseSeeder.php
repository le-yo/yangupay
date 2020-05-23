<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(MenuSeeder::class);
         $this->call(MenuItemSeeder::class);
         $this->call(AccountSeeder::class);
    }
}
