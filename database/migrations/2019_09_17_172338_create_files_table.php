<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('extension')->nullable();
            $table->string('hd')->nullable();
            $table->string('sd')->nullable();
            $table->string('thumb')->nullable();
            $table->string('thumb_hd')->nullable();
            $table->bigInteger('size_in_bytes')->nullable();
            $table->longText('embed')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('private')->default(true);
            $table->enum('status', ['complete', 'processing', 'failed'])->default('processing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
