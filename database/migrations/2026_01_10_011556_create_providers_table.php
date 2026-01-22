<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->string('ruc', 13);
            $table->string('business_name');
            $table->string('trade_name')->nullable();
            $table->foreignId('provider_type_id')->constrained('provider_types');
            $table->boolean('is_special_taxpayer')->default(false);
            $table->string('retention_code_iva')->nullable();
            $table->string('retention_code_renta')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('website')->nullable();
            $table->integer('credit_days')->default(0);
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
