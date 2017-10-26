<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTeamsIndexView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view sales_teams_index as select  sales_teams.id, sales_teams.name as name, users.id as manager_id, users.first_name as manager_first_name, users.last_name as manager_last_name, count(sales_teams_users.user_id) as user_count  from sales_teams inner join sales_teams_users on sales_teams_users.sales_team_id=sales_teams.id and sales_teams.deleted_at is null INNER JOIN users on users.id = sales_teams_users.user_id group by sales_teams.id');
        //

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("DROP VIEW sales_teams_index");
        //
    }
}
