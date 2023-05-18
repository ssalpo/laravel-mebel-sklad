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
        Schema::create('nomenclature_arrivals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomenclature_id')->constrained();
            $table->foreignId('supplier_id')->constrained();
            $table->double('quantity')->default(0);
            $table->decimal('base_price')->default(0);
            $table->decimal('price_for_sale')->default(0);
            $table->text('comment')->nullable();
            $table->timestamp('arrival_at')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomenclature_arrivals');
    }
};
