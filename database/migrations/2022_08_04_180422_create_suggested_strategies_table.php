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
        Schema::create('suggested_strategies', function (Blueprint $table) {
            $table->id();
            $table->string("label");
            $table->longText("text");
            $table->unsignedInteger("category"); //See App\Constants\Strategies\StrategyCategory
            $table->unsignedInteger("type"); //See App\Constants\Strategies\StrategyType
            $table->unsignedBigInteger("project_id"); //See App\Constants\Strategies\StrategyType
            $table->timestamps();
            
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
        Schema::dropIfExists('suggested_strategies');
    }
};
