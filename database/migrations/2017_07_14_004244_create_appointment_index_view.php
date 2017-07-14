<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentIndexView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("CREATE VIEW appointments_index AS select `appointments`.`id`, `appointments`.`title`, `appointments`.`description`, `appointments`.`start_time`, `appointments`.`end_time`, `appointments`.`status`, customer.last_name AS customer_last_name, customer.first_name AS customer_first_name, company.name AS company_name, customer.id AS customer_id, company.id AS company_id, CONCAT(CONCAT(customer.last_name, ',', customer.first_name),'@', company.name ) AS customer_name from `appointments` inner join `customers` as `customer` on `appointments`.`customer_id` = `customer`.`id` inner join `customer_companies` as `company` on `customer`.`customer_company_id` = `company`.`id` where `appointments`.`deleted_at` is null");
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
