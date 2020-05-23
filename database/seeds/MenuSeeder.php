<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
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
        DB::table('ussd_menus')->truncate();

        DB::table('ussd_menus')->delete();

        DB::table('ussd_menus')->insert(array(
            array(
                'title' => 'Donate safely to A. N. Other',
                'description' => 'Process to donate to somebody',
                'is_root' => 1,
                'type' => 3,
                'skippable'=>true,
                'next_mifos_ussd_menu_id'=>2,
                'confirmation_message' => "Please proceed to enter your M-PESA PIN in the next screen",
            ),
        ));
    }
}
