<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsIndexView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("CREATE VIEW appointments_index AS select `appointments`.`id`, `appointments`.`title`, `appointments`.`description`, `appointments`.`start_time`, `appointments`.`end_time`, `appointments`.`status`, customer.last_name AS customer_last_name, customer.first_name AS customer_first_name, account.name AS account_name, customer.id AS customer_id, account.id AS account_id, account.account_no AS account_no, CONCAT(CONCAT(customer.last_name, ',', customer.first_name),'@', account.name ) AS customer_name from `appointments` inner join `customers` as `customer` on `appointments`.`customer_id` = `customer`.`id` inner join `accounts` as `account` on `customer`.`account_id` = `account`.`id` where `appointments`.`deleted_at` is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("DROP VIEW appointments_index");
    }
}
