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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->nullable()->constrained('tenants', 'id')->cascadeOnDelete();
            $table->foreignId('project_work_id')->constrained('project_works', 'id')->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->json('tags');
            $table->timestamp('date');
            $table->string('source_code')->nullable();
            $table->string('website_url')->nullable();
            $table->string('other')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
