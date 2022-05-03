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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status')->nullable();
            $table->string('emailSender');
            $table->string('emailRecipient');
            $table->string('email_recipient');
            $table->foreignId('sender_id');
            $table->foreignId('recipient_id')->nullable();
            $table->foreignId('sender_address_id');
            $table->foreignId('recipient_address_id');
            $table->string('tracking_code')->nullable()->unique();
            $table->dateTime('pick_up_time')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
