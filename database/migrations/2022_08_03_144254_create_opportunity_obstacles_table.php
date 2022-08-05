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
        Schema::create('opportunity_obstacles', function (Blueprint $table) {
            $table->id();
            $table->longText("opportunity")->nullable();
            $table->longText("obstacle")->nullable();
            $table->longText("comments")->nullable();
            $table->boolean("is_more_research_needed")->nullable();
            $table->unsignedBigInteger("player_id");
            $table->unsignedBigInteger("project_id");
            $table->timestamps();

            $table->foreign("player_id")->references("id")->on("players")->cascadeOnDelete();
            $table->foreign("project_id")->references("id")->on("projects")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunity_obstacles');
    }
};
