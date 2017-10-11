<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupIndexView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('CREATE VIEW user_groups_index as select user_groups.id as id, user_groups.name as name, count(group_users.user_id) as user_count  from user_groups inner join group_users on group_users.group_id=user_groups.id and user_groups.deleted_at is null group by user_groups.id');
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    \Illuminate\Support\Facades\DB::statement("DROP VIEW user_groups_index");
}
}
