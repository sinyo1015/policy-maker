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
        Schema::create('position_scales', function (Blueprint $table) {
            $table->id();
            // $table->string("name");
            // $table->integer("non_mobilized_position_intensity")->default(0);
            
            $table->float("ps_dh")->default(0.0); //Deny High
            $table->float("ps_dmh")->default(0.0); //Deny Medium High
            $table->float("ps_dml")->default(0.0); //Deny Medium Low
            $table->float("ps_dlh")->default(0.0); //Deny Low High
            $table->float("ps_dll")->default(0.0); //Deny Low Low
            $table->float("ps_nh")->default(0.0); //Neutral High 
            $table->float("ps_nl")->default(0.0); //Neutral Low
            $table->float("ps_sll")->default(0.0); //Support Low Low
            $table->float("ps_slh")->default(0.0); //Support Low High
            $table->float("ps_sml")->default(0.0); //Support Medium Low
            $table->float("ps_smh")->default(0.0); //Support Medium High
            $table->float("ps_sh")->default(0.0); //Support High
            
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
        Schema::dropIfExists('position_scales');
    }
};
