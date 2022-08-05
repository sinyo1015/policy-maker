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
        Schema::create('policy_consequences', function (Blueprint $table) {
            $table->id();
            $table->longText("description");
            $table->longText("size_of_consequence");
            $table->longText("timing_of_consequence");
            $table->unsignedBigInteger("consequence_id")->nullable();
            $table->unsignedInteger("importance");
            $table->unsignedBigInteger("player_id");
            $table->unsignedBigInteger("project_id");
            $table->timestamps();

            $table->foreign("consequence_id")->references("id")->on("consequences")->onDelete("SET NULL");
            $table->foreign("player_id")->references("id")->on("players")->onDelete("cascade");
            $table->foreign("project_id")->references("id")->on("projects")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_consequences');
    }
};
