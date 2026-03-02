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
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('expense_id')->constrained()->cascadeOnDelete();
            $table->foreignId('debtor_id')->constrained('users')->cascadeOnDelete(); // Who owes
            $table->foreignId('creditor_id')->constrained('users')->cascadeOnDelete(); // Who is owed
            $table->decimal('amount', 8, 2);
            $table->boolean('is_paid')->default(false);
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
};
