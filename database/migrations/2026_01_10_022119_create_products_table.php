<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('unit_measurement', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sri_code');
            $table->string('sri_percentage_code');
            $table->decimal('rate', 5, 2);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->string('name');
            $table->string('slug');
            $table->string('sku');
            $table->string('bar_code')->nullable();
            $table->foreignId('product_type_id')->constrained('product_types');
            $table->foreignId('tax_id')->constrained('taxes');
            $table->foreignId('unit_measurement')->constrained('unit_measurement');
            $table->integer('minimum_stock')->default(0);
            $table->boolean('is_stockable')->default(false);
            $table->decimal('last_cost', 10, 2)->nullable();
            $table->decimal('average_cost', 10, 2)->nullable();
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['company_id', 'sku']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
