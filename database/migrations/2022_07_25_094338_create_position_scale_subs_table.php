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
        Schema::create('position_scale_subs', function (Blueprint $table) {
            $table->id();
            $table->integer("scale");
            $table->integer("type")->default(0); //See App\Constants\PositionScale
            $table->unsignedBigInteger("position_scale_id");
            $table->timestamps();

            $table->foreign("position_scale_id")->references("id")->on("position_scales")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position_scale_subs');
    }
};
