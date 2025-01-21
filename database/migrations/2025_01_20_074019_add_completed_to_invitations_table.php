<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompletedToInvitationsTable extends Migration
{
    public function up()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->boolean('completed')->default(false)->after('token');
        });
    }

    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn('completed');
        });
    }
}

