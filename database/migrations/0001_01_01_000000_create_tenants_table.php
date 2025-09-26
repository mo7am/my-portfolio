<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_default')->default(false)->index();
            $table->boolean('is_show_educational')->default(true);
            $table->boolean('is_show_experience')->default(true);
            $table->boolean('is_show_language')->default(true);
            $table->boolean('is_show_skill')->default(true);
            $table->boolean('is_show_project')->default(true);
            $table->boolean('is_show_link')->default(true);
            $table->boolean('is_show_contact')->default(true);
            $table->boolean('is_show_download_cv')->default(true);
            $table->boolean('is_show_website')->default(true);
            $table->softDeletes()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
