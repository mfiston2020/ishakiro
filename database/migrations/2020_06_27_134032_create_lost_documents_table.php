<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('founder_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('document_type',40);
            $table->string('document_number',40);
            $table->string('place_of_keep',40);
            $table->string('status',1);
            $table->timestamps();

            $table->foreign('owner_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('founder_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lost_documents');
    }
}
