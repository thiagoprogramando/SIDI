<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('SIDI');
            $table->longText('description')->nullable();
            $table->decimal('value', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product');
    }
};
