<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_settings', function (Blueprint $table) {
            $table->id();
            $table->json('hero_eyebrow')->nullable();
            $table->json('hero_title')->nullable();
            $table->json('hero_subtitle')->nullable();
            $table->json('hero_cta_primary')->nullable();
            $table->json('hero_cta_secondary')->nullable();
            $table->json('final_cta_title')->nullable();
            $table->json('final_cta_subtitle')->nullable();
            $table->json('final_cta_primary')->nullable();
            $table->json('final_cta_secondary')->nullable();
            $table->json('footer_tagline')->nullable();
            $table->json('announcement_text')->nullable();
            $table->boolean('announcement_enabled')->default(false);
            $table->string('announcement_url')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_github')->nullable();
            $table->string('social_facebook')->nullable();
            $table->timestamps();
        });

        Schema::create('landing_items', function (Blueprint $table) {
            $table->id();
            $table->string('type', 32)->index();
            $table->json('title');
            $table->json('body')->nullable();
            $table->string('icon', 64)->nullable();
            $table->string('meta', 64)->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('landing_faqs', function (Blueprint $table) {
            $table->id();
            $table->json('question');
            $table->json('answer');
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('landing_testimonials', function (Blueprint $table) {
            $table->id();
            $table->json('quote');
            $table->json('name');
            $table->json('role')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('landing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('code', 64)->unique();
            $table->json('name');
            $table->json('description')->nullable();
            $table->json('badge')->nullable();
            $table->json('cta_label')->nullable();
            $table->json('period_label')->nullable();
            $table->json('features')->nullable();
            $table->decimal('price_monthly', 10, 2)->default(0);
            $table->string('currency', 8)->default('USD');
            $table->boolean('is_highlighted')->default(false);
            $table->string('cta_route')->default('register');
            $table->json('cta_params')->nullable();
            $table->string('billing_plan_id')->nullable()->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_plans');
        Schema::dropIfExists('landing_testimonials');
        Schema::dropIfExists('landing_faqs');
        Schema::dropIfExists('landing_items');
        Schema::dropIfExists('landing_settings');
    }
};
