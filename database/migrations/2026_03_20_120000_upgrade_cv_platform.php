<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            if (! Schema::hasColumn('experiences', 'company')) {
                $table->string('company')->nullable()->after('title');
            }
            if (! Schema::hasColumn('experiences', 'location')) {
                $table->string('location')->nullable()->after('company');
            }
            if (! Schema::hasColumn('experiences', 'employment_type')) {
                $table->string('employment_type')->nullable()->after('location');
            }
        });

        Schema::table('educationals', function (Blueprint $table) {
            if (! Schema::hasColumn('educationals', 'institution')) {
                $table->string('institution')->nullable()->after('educational');
            }
            if (! Schema::hasColumn('educationals', 'degree')) {
                $table->string('degree')->nullable()->after('institution');
            }
            if (! Schema::hasColumn('educationals', 'field')) {
                $table->string('field')->nullable()->after('degree');
            }
            if (! Schema::hasColumn('educationals', 'location')) {
                $table->string('location')->nullable()->after('field');
            }
            if (! Schema::hasColumn('educationals', 'gpa')) {
                $table->string('gpa')->nullable()->after('location');
            }
        });

        Schema::table('skills', function (Blueprint $table) {
            if (! Schema::hasColumn('skills', 'level')) {
                $table->string('level')->nullable()->after('skill');
            }
            if (! Schema::hasColumn('skills', 'category')) {
                $table->string('category')->nullable()->after('level');
            }
        });

        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'role')) {
                $table->string('role')->nullable()->after('title');
            }
            if (! Schema::hasColumn('projects', 'type')) {
                $table->string('type')->nullable()->after('role');
            }
        });

        Schema::table('tenants', function (Blueprint $table) {
            foreach ([
                'is_show_certification',
                'is_show_course',
                'is_show_award',
                'is_show_volunteering',
                'is_show_reference',
            ] as $col) {
                if (! Schema::hasColumn('tenants', $col)) {
                    $table->boolean($col)->default(true);
                }
            }
        });

        if (! Schema::hasTable('certifications')) {
            Schema::create('certifications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->string('title');
                $table->string('issuer')->nullable();
                $table->timestamp('issued_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->string('credential_id')->nullable();
                $table->string('url')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->string('title');
                $table->string('provider')->nullable();
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('awards')) {
            Schema::create('awards', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->string('title');
                $table->string('issuer')->nullable();
                $table->timestamp('awarded_at')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('volunteerings')) {
            Schema::create('volunteerings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->string('organization');
                $table->string('role')->nullable();
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('cv_references')) {
            Schema::create('cv_references', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->string('name');
                $table->string('position')->nullable();
                $table->string('company')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->boolean('is_public')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cv_references');
        Schema::dropIfExists('volunteerings');
        Schema::dropIfExists('awards');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('certifications');
    }
};
