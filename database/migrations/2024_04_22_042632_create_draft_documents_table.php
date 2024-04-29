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
        Schema::create('draft_documents', function (Blueprint $table) {
            $table->id();
            $table->string("date", 100);
            $table->string("subject");
            $table->string('source', 100);
            $table->string('destination', 100);
            $table->text("content");
            $table->string('status')->default('Pending');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_documents');
    }
};
