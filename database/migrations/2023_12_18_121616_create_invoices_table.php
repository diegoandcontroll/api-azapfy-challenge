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
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('amount', 10, 2)->default(0);
            $table->date('emission_date');
            $table->string('sender_cnpj', 14);
            $table->string('sender_name', 100);
            $table->string('transporter_cnpj', 14);
            $table->string('transporter_name', 100);
            $table->string('file')->default('');
            $table->timestamps();

            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
