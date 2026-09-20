<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('educationals', function (Blueprint $table) {
            $table->timestamp('end_date')->nullable()->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['project_work_id']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('project_work_id')->nullable()->change();
            $table->foreign('project_work_id')
                ->references('id')
                ->on('project_works')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['project_work_id']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('project_work_id')->nullable(false)->change();
            $table->foreign('project_work_id')
                ->references('id')
                ->on('project_works')
                ->cascadeOnDelete();
        });

        Schema::table('educationals', function (Blueprint $table) {
            $table->timestamp('end_date')->nullable(false)->change();
        });
    }
};
