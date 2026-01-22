<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 3);
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('product_provider', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('provider_id')->constrained('providers');
            $table->string('sku')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies');
            $table->decimal('cost', 10, 2)->nullable();
            $table->boolean('is_default')->default(false);
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['company_id', 'product_id', 'provider_id']);
        });

        DB::statement("
            CREATE UNIQUE INDEX product_provider_one_default
            ON product_provider (product_id)
            WHERE is_default = true
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('product_provider');
    }
};
