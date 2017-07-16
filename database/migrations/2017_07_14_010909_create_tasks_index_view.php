<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksIndexView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("CREATE VIEW tasks_index AS select `tasks`.`id`, `tasks`.`title`, `tasks`.`description`, `tasks`.`due_date`, `tasks`.`status`, `tasks`.`priority`, customer.last_name AS customer_last_name, customer.first_name AS customer_first_name, account.name AS account_name, customer.id AS customer_id, account.id AS account_id, CONCAT(CONCAT(customer.last_name, ',', customer.first_name),'@', account.name ) AS customer_name from `tasks` inner join `customers` as `customer` on `tasks`.`customer_id` = `customer`.`id` inner join `accounts` as `account` on `customer`.`account_id` = `account`.`id` where `tasks`.`deleted_at` is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("DROP VIEW tasks_index");
    }
}
