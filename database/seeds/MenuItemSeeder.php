<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ussd_menu_items')->truncate();

        DB::table('ussd_menu_items')->delete();

        DB::table('ussd_menu_items')->insert(array(
            array(
                'menu_id' => 1,
                'description' => "Enter Amount you'd like to donate",
                'next_menu_id' => 0,
                'step' => 1,
                'validation' => 'custom',
                'confirmation_phrase' => 'Amount',
            ),
        ));
    }
}
