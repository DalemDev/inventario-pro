<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->char('iso_code_2', 2)->unique();
            $table->char('iso_code_3', 3)->unique();
            $table->string('phone_code', 10);
            $table->char('currency_code', 3);
            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->string('name', 100);
            $table->char('code', 10);
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('zip_code', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('parishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('code', 10)->unique();
            $table->enum('type', ['urbana', 'rural']);
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('alias', 50);
            $table->boolean('is_main')->default(false);
            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('state_id')->constrained('states');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('parish_id')->nullable()->constrained('parishes');
            $table->string('main_street');
            $table->string('number_street', 20);
            $table->string('secondary_street');
            $table->text('reference');
            $table->string('zip_code', 20);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generales');
    }
};
