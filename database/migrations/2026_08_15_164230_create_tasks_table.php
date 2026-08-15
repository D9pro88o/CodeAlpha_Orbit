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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_list_id')->constrained()->cascadeOnDelete(); //fillable
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete(); //fillable
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete(); //fillable
            $table->string('title'); //fillable
            $table->text('description')->nullable(); //fillable
            $table->date('due_date')->nullable(); //fillable
            $table->integer('position')->default(0); //fillable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
