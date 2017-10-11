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
        \Illuminate\Support\Facades\DB::statement('CREATE VIEW user_groups_index as SELECT group_users.user_id, user_groups.name, count(group_users.user_id)
FROM group_users INNER JOIN user_groups ON user_groups.id=group_users.group_id AND user_groups.deleted_at IS NULL
GROUP BY group_users.user_id;');
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
