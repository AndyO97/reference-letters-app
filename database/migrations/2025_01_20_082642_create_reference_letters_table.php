<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceLettersTable extends Migration
{
    public function up()
    {
        Schema::create('reference_letters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('student_email');
            $table->unsignedBigInteger('professor_id')->nullable();
            $table->string('professor_email');
            $table->string('relationship');
            $table->text('comments')->nullable();
            $table->string('reference_file_path'); // Path for the main reference letter
            $table->json('supporting_documents')->nullable(); // Array of supporting document paths
            $table->timestamps();

            // Optional foreign key constraints
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reference_letters');
    }
}


