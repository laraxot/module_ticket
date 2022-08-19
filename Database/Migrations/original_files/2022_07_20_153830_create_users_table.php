<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->tableCreate(
            function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('gender');
            $table->string('email')->nullable()->unique();
            $table->boolean('ban');
            $table->string('password', 60);
            $table->integer('active');
            $table->boolean('is_delete')->default(false);
            $table->string('ext');
            $table->integer('country_code');
            $table->string('phone_number');
            $table->string('mobile')->nullable()->unique();
            $table->text('agent_sign');
            $table->string('account_type');
            $table->string('account_status');
            $table->unsignedInteger('assign_group')->nullable()->index('assign_group_3');
            $table->unsignedInteger('primary_dpt')->nullable()->index('primary_dpt_2');
            $table->string('agent_tzone');
            $table->string('daylight_save');
            $table->string('limit_access');
            $table->string('directory_listing');
            $table->string('vacation_mode');
            $table->string('company');
            $table->string('role');
            $table->string('internal_note');
            $table->string('profile_pic');
            $table->rememberToken();
            $table->timestamps();
            $table->string('user_language', 10)->nullable();
        });
    }
}
