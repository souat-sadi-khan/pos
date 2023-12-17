<?php

use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GeneralSettingSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create default navbar top
        Setting::create([
            'name'      =>  'navbar_position',
            'value'     =>  'top',
        ]);

        // Create Log Event
        Setting::create([
            'name'      => 'log_event',
            'value'     => 'created,updated,deleted', 
        ]);

        //  Create log_delete_date
        Setting::create([
            'name'      =>  'log_delete_date',
            'value'     =>  '365',
        ]);

        //  Create log_delete_date
        Setting::create([
            'name'      =>  'log_report',
            'value'     =>  'on',
        ]);

        // ip_filter off
        Setting::create([
            'name'      =>  'ip_filter',
            'value'     =>  'off',
        ]);

        // Create Payment Method 
        PaymentMethod::create([
            'method_name'  =>  'Cash On Delivery',
            'method_code_name' => 'COD',
            'status'   => '1',
        ]);

        // Creating a Waking Customer
        Customer::create([
            'uuid'  => Str::uuid(),
            'customer_name' => 'Walking Customer',
            'credit_balance' => 0,
            'customer_mobile' => '01700000000',
            'status' => 1,
        ]);
    }
}
