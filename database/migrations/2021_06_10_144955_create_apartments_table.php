<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 100);
            $table->text('description');
            $table->tinyInteger('rooms');
            $table->tinyInteger('bathrooms');
            $table->tinyInteger('beds');
            $table->smallInteger('mq');
            $table->string('address', 100);
            $table->string('city', 50);
            $table->double('lat', 9,6);
            $table->double('long', 9.6);
            $table->string('image')->nullable();
            $table->boolean('visible')->default(0);
            $table->string('slug', 120);
            //$table->string('slug', 120)->unique();
            ///////////////////////////////////////
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
