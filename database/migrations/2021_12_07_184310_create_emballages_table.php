<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmballagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emballages', function (Blueprint $table) {
            $table->id();
            $table->string('customer_fullname')->nullable();
            $table->string('customer_contact')->nullable();
            $table->string('customer_contact_phone')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->boolean('lifting_equipment')->default(0);
            $table->text('comments')->nullable();
            $table->integer('diameter_60')->default(0);
            $table->integer('diameter_80')->default(0);
            $table->integer('diameter_100')->default(0);
            $table->integer('diameter_120')->default(0);
            $table->integer('diameter_140')->default(0);
            $table->integer('diameter_160')->default(0);
            $table->integer('diameter_180')->default(0);
            $table->integer('diameter_200')->default(0);
            $table->integer('user');
            $table->string('status')->default('ingediend');
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('emballages');
    }
}
