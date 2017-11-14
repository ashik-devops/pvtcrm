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
        \Illuminate\Support\Facades\DB::statement('CREATE VIEW `sales_teams_index`
AS SELECT
   `sales_teams`.`id` AS `id`,
   `sales_teams`.`name` AS `name`,
   `users`.`id` AS `manager_id`,
   CONCAT(`users`.`last_name`, ", ", `users`.`first_name`) AS `manager_name`, count(`sales_teams_users`.`user_id`) AS `user_count`
FROM ((`sales_teams` join `sales_teams_users` on(((`sales_teams_users`.`sales_team_id` = `sales_teams`.`id`) and isnull(`sales_teams`.`deleted_at`)))) join `users` on((`users`.`id` = `sales_teams_users`.`user_id`))) group by `sales_teams`.`id`');
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
