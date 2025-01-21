<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNameToUsernameInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Create the new column
            $table->string('username')->after('id'); // Adjust the `after` position if necessary.
        });

        // Migrate data from `name` to `username`
        \DB::statement('UPDATE users SET username = name');

        // Drop the old column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Create the old column again
            $table->string('name')->after('id');
        });

        // Migrate data back from `username` to `name`
        \DB::statement('UPDATE users SET name = username');

        // Drop the new column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
}
