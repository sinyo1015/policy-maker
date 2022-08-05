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
        Schema::create('policy_interests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("player_id");
            $table->unsignedBigInteger("project_id");
            $table->unsignedBigInteger("interest_id")->nullable();
            $table->unsignedInteger("priority");
            $table->longText("interest");
            $table->timestamps();

            $table->foreign("player_id")->references("id")->on("players")->cascadeOnDelete();
            $table->foreign("interest_id")->references("id")->on("interests")->cascadeOnDelete();
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
        Schema::dropIfExists('policy_interests');
    }
};
