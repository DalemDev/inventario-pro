<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('code', 3);
            $table->timestamps();
        });

        Schema::create('company_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('legal_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('code', 10);
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trade_name');
            $table->foreignId('company_type_id')->constrained('company_types');
            $table->foreignId('legal_type_id')->constrained('legal_types');
            $table->string('legal_code')->unique();
            $table->string('email')->unique();
            $table->string('phone');
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
        Schema::dropIfExists('company_codes');
        Schema::dropIfExists('legal_codes');
        Schema::dropIfExists('companies');
    }
};
