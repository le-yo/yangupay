<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
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
        DB::table('accounts')->truncate();

        DB::table('accounts')->delete();

        DB::table('accounts')->insert(array(
            array(
                'name' => 'Sample Name',
                'code' => '100',
            ),
        ));
    }
}
