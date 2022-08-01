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
        Schema::create('power_scales', function (Blueprint $table) {
            $table->id();
            // $table->integer("power")->default(0);
            // $table->integer("indicator")->default(0); //See App\Constants\PowerScale

            $table->float("pw_l")->default(0.0);
            $table->float("pw_ml")->default(0.0);
            $table->float("pw_mh")->default(0.0);
            $table->float("pw_h")->default(0.0);

            $table->unsignedBigInteger("project_id");
            $table->timestamps();

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
        Schema::dropIfExists('power_scales');
    }
};
