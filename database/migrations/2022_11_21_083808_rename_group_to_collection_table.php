<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameGroupToCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('groups', 'collections');
        Schema::table('notifications', function (Blueprint $table) {
            $table->renameColumn('group_id', 'collection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('collections', 'groups');
        Schema::table('notifications', function (Blueprint $table) {
            $table->renameColumn('collection_id', 'group_id');
        });
    }
}