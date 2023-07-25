<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_telephone_number');
            $table->string('customer_email');
            $table->date('date');
            $table->boolean('canceled');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('treatment_id')->constrained('treatments');
            $table->foreignId('timeblock_id')->constrained('timeblocks');
            $table->foreignId('seat_id')->nullable()->constrained('seats');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
