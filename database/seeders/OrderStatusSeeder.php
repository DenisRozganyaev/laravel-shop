<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = config('constants.db.order_statuses');

        foreach ($statuses as $status) {
            OrderStatus::firstOrCreate(['name' => $status]);
        }
    }
}
