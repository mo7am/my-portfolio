<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'cv_drive_link')) {
                $table->string('cv_drive_link')->nullable()->after('job_description');
            }
            if (! Schema::hasColumn('users', 'cv_drive_file_id')) {
                $table->string('cv_drive_file_id')->nullable()->after('cv_drive_link');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'cv_drive_file_id')) {
                $table->dropColumn('cv_drive_file_id');
            }
            if (Schema::hasColumn('users', 'cv_drive_link')) {
                $table->dropColumn('cv_drive_link');
            }
        });
    }
};
