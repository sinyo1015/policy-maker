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
        Schema::create('project_policies', function (Blueprint $table) {
            $table->id();
            $table->longText("goal");
            $table->longText("mechanism");
            $table->longText("indicator");
            $table->unsignedBigInteger("priority")->nullable();
            $table->longText("comments")->nullable();
            $table->boolean("is_more_research_needed")->nullable();
            $table->unsignedBigInteger("agenda_id")->nullable();
            $table->unsignedBigInteger("project_id");
            $table->timestamps();

            $table->foreign("agenda_id")->references("id")->on("agendas")->onDelete("cascade");
            $table->foreign("project_id")->references("id")->on("projects")->onDelete("cascade");
            // $table->foreign("priority")->references("id")->on("power_scales")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_policies');
    }
};
