<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->boolean('already_read')->nullable(false);
            $table->boolean('hide_next_time')->nullable(false);
            $table->string('jump_link');
            $table->integer('notify_priority')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('already_read');
            $table->dropColumn('hide_next_time');
            $table->dropColumn('jump_link');
            $table->dropColumn('notify_priority');
        });
    }
}