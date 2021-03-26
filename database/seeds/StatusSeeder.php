<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                'status_name'                 => 'Created',
                'status_code'              => 'created',
                'status_description'            => 'Order have been created'
            ],
            [
                'status_name'                 => 'Done',
                'status_code'              => 'done',
                'status_description'            => 'Order successfully done'
            ],
            [
                'status_name'                 => 'Edited',
                'status_code'              => 'edited',
                'status_description'            => 'Order is edited, not done'
            ],
            [
                'status_name'                 => 'Deleted',
                'status_code'              => 'deleted',
                'status_description'            => 'Order is marked as deleted'
            ],
        ]);
    }
}
