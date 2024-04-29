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
        Schema::create('new_documents', function (Blueprint $table) {
            $table->id();
            $table->string('number', 100);
            $table->string('source', 200);
            $table->string('destination', 200);
            $table->text('description')->nullable();
            $table->text('remark')->nullable();
            $table->string('document_type', 200);
            $table->string('attachment');
            $table->string('attachment_path');
            $table->string('date');
            $table->bigInteger('department_id')->unsigned()->index();
            $table->foreign("department_id")->references('id')->on("user_departments");
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
        Schema::dropIfExists('new_documents');
    }
};
