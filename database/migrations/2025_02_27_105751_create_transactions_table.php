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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense'])->nullable(false);
            $table->decimal('amount', 10, 2)->nullable(false);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('profile_id')->nullable(false);
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->date('transaction_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
