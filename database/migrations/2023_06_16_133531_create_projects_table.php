<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('name', 50);
            $table->string('original_img_name')->nullable();
            $table->string('image_path')->nullable();
            $table->string('slug', 50)->unique();
            $table->string('purpose');
            $table->text('team_members')->nullable();
            $table->string('project_manager', 50)->nullable();
            $table->string('repository');
            $table->text('description');
            $table->string('technologies');
            $table->boolean('is_done')->default('0');
            $table->timestamps();
            $table->foreign('type_id')
                  ->references('id')
                  ->on('types')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('projects');

    }
};
