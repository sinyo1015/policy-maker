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
        Schema::create('strategies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("player_id");
            $table->unsignedBigInteger("predefined_strategy_id");
            $table->longText("strategy_action")->nullable();
            $table->longText("challanges")->nullable();
            $table->longText("timelines")->nullable();
            $table->unsignedInteger("probability");
            $table->unsignedBigInteger("project_id");
            $table->timestamps();

            $table->foreign("player_id")->references("id")->on("players")->cascadeOnDelete();
            $table->foreign("predefined_strategy_id")->references("id")->on("suggested_strategies")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strategies');
    }
};
