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
        Schema::dropIfExists('wallet_transactions');
        
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'wallet_balance')) {
                $table->dropColumn('wallet_balance');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            // Remove 'wallet' from enum if possible, or just ignore. 
            // Changing enum is tricky. We already changed payment_method to string in a previous step.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->string('description')->nullable();
            $table->string('reference')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
        });
    }
};
