<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersIndexView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("CREATE VIEW customers_index as select `customers`.`id`, CONCAT(`customers`.`first_name`, ', ', `customers`.`last_name`) as `name`, `customers`.`email`, `profile`.`primary_phone_no` as `phone_no`, `customers`.`priority`, `account`.`account_no`,`account`.`id` as `account_id`, `account`.`name` as `account_name`, `profile`.`initial` as `user_name`, `user`.`id` as `user_id`

FROM `customers`
INNER JOIN `users` as `user` on `user`.`id` = `customers`.`user_id` 
INNER JOIN `user_profiles` as `profile` on `user`.`id` = `profile`.`user_id`
INNER JOIN `accounts` as `account` on `account`.`id` = `customers`.`account_id`

where `customers`.`deleted_at` is null and `account`.`deleted_at` is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('DROP VIEW customers_index');
    }
}
