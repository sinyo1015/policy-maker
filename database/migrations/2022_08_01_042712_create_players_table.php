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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("alt_name");
            $table->longText("details");
            $table->unsignedBigInteger("sector_id")->nullable();
            $table->unsignedBigInteger("level_id")->nullable();
            $table->float("position");
            $table->float("power");
            $table->unsignedBigInteger("project_id");
            $table->double("pos_x")->nullable();
            $table->double("pos_y")->nullable();
            $table->timestamps();

            $table->foreign("sector_id")->references("id")->on("sectors")->onDelete("SET NULL");
            $table->foreign("level_id")->references("id")->on("level_names")->onDelete("SET NULL");
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
        Schema::dropIfExists('players');
    }
};
