<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wapi_messages', function (Blueprint $table) {
            $table->id();
            $table->string("from");
            $table->string("displayName")->nullable();
            $table->string("to");
            $table->integer("counter");
            $table->boolean("fromMe")->default(false);
            $table->string("type");
            $table->text("messageText");
            $table->string("messageId");
            $table->string("messageHash");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wapi_messages');
    }
};
