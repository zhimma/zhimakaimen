<?php

use Illuminate\Database\Seeder;

class AdminRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = DB::table('Admins')->where(['account' => 'zhimma'])->first();
        DB::table('admin_relations')->insert([
            'admin_id' => $admins->id,
            'email' => 'mma5694@zhimma.com',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
