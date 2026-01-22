<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('restrict');
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->text('description')->nullable();
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['company_id', 'name'], 'categories_unique_index');
            $table->unique(['company_id', 'slug'], 'categories_slug_index');
            $table->unique(['company_id', 'code'], 'categories_code_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
