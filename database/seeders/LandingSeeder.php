<?php

namespace Database\Seeders;

use App\Enums\LandingItemType;
use App\Models\LandingFaq;
use App\Models\LandingItem;
use App\Models\LandingPlan;
use App\Models\LandingSetting;
use App\Models\LandingTestimonial;
use Illuminate\Database\Seeder;

class LandingSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSettings();
        $this->seedItems();
        $this->seedTestimonials();
        $this->seedPlans();
        $this->seedFaqs();
    }

    protected function seedSettings(): void
    {
        if (LandingSetting::query()->exists()) {
            return;
        }

        LandingSetting::query()->create([
            'hero_eyebrow' => $this->t('landing.hero.eyebrow'),
            'hero_title' => $this->t('landing.hero.title'),
            'hero_subtitle' => $this->t('landing.hero.subtitle'),
            'hero_cta_primary' => $this->t('landing.hero.cta_primary'),
            'hero_cta_secondary' => $this->t('landing.hero.cta_secondary'),
            'final_cta_title' => $this->t('landing.final_cta.title'),
            'final_cta_subtitle' => $this->t('landing.final_cta.subtitle'),
            'final_cta_primary' => $this->t('landing.final_cta.cta'),
            'final_cta_secondary' => $this->t('landing.final_cta.secondary'),
            'footer_tagline' => $this->t('landing.footer.tagline'),
            'announcement_enabled' => false,
            'contact_email' => config('landing.contact_email'),
        ]);
    }

    protected function seedItems(): void
    {
        if (LandingItem::query()->exists()) {
            return;
        }

        $featureIcons = ['globe', 'layers', 'file', 'languages', 'cloud', 'sliders'];
        $featureKeys = ['portfolio', 'sections', 'pdf', 'bilingual', 'drive', 'visibility'];

        foreach ($featureKeys as $i => $key) {
            LandingItem::query()->create([
                'type' => LandingItemType::Feature,
                'title' => $this->t("landing.features.items.{$key}.title"),
                'body' => $this->t("landing.features.items.{$key}.body"),
                'icon' => $featureIcons[$i],
                'sort_order' => $i + 1,
                'is_published' => true,
            ]);
        }

        $steps = ['signup', 'fill', 'share'];
        foreach ($steps as $i => $key) {
            LandingItem::query()->create([
                'type' => LandingItemType::Step,
                'title' => $this->t("landing.how.steps.{$key}.title"),
                'body' => $this->t("landing.how.steps.{$key}.body"),
                'meta' => str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
                'sort_order' => $i + 1,
                'is_published' => true,
            ]);
        }

        $benefits = ['one_link', 'always_fresh', 'application_ready', 'own_brand'];
        foreach ($benefits as $i => $key) {
            LandingItem::query()->create([
                'type' => LandingItemType::Benefit,
                'title' => $this->t("landing.benefits.items.{$key}.title"),
                'body' => $this->t("landing.benefits.items.{$key}.body"),
                'sort_order' => $i + 1,
                'is_published' => true,
            ]);
        }

        $useCases = ['developers', 'designers', 'students', 'professionals'];
        foreach ($useCases as $i => $key) {
            LandingItem::query()->create([
                'type' => LandingItemType::UseCase,
                'title' => $this->t("landing.use_cases.items.{$key}.title"),
                'body' => $this->t("landing.use_cases.items.{$key}.body"),
                'sort_order' => $i + 1,
                'is_published' => true,
            ]);
        }
    }

    protected function seedTestimonials(): void
    {
        if (LandingTestimonial::query()->exists()) {
            return;
        }

        foreach (['1', '2', '3'] as $i => $key) {
            LandingTestimonial::query()->create([
                'quote' => $this->t("landing.testimonials.items.{$key}.quote"),
                'name' => $this->t("landing.testimonials.items.{$key}.name"),
                'role' => $this->t("landing.testimonials.items.{$key}.role"),
                'sort_order' => $i + 1,
                'is_published' => true,
            ]);
        }
    }

    protected function seedPlans(): void
    {
        if (LandingPlan::query()->exists()) {
            return;
        }

        $freeFeatures = [
            'en' => array_values(__('landing.plans.free.features', [], 'en')),
            'ar' => array_values(__('landing.plans.free.features', [], 'ar')),
        ];
        $proFeatures = [
            'en' => array_values(__('landing.plans.pro.features', [], 'en')),
            'ar' => array_values(__('landing.plans.pro.features', [], 'ar')),
        ];

        LandingPlan::query()->create([
            'code' => 'free',
            'name' => $this->t('landing.plans.free.name'),
            'description' => $this->t('landing.plans.free.description'),
            'badge' => null,
            'cta_label' => $this->t('landing.plans.free.cta'),
            'period_label' => $this->t('landing.plans.period_month'),
            'features' => $freeFeatures,
            'price_monthly' => 0,
            'currency' => 'USD',
            'is_highlighted' => false,
            'cta_route' => 'register',
            'cta_params' => ['plan' => 'free'],
            'sort_order' => 1,
            'is_published' => true,
        ]);

        LandingPlan::query()->create([
            'code' => 'pro',
            'name' => $this->t('landing.plans.pro.name'),
            'description' => $this->t('landing.plans.pro.description'),
            'badge' => $this->t('landing.plans.pro.badge'),
            'cta_label' => $this->t('landing.plans.pro.cta'),
            'period_label' => $this->t('landing.plans.period_month'),
            'features' => $proFeatures,
            'price_monthly' => 9,
            'currency' => 'USD',
            'is_highlighted' => true,
            'cta_route' => 'register',
            'cta_params' => ['plan' => 'pro'],
            'sort_order' => 2,
            'is_published' => true,
        ]);
    }

    protected function seedFaqs(): void
    {
        if (LandingFaq::query()->exists()) {
            return;
        }

        for ($i = 1; $i <= 6; $i++) {
            LandingFaq::query()->create([
                'question' => $this->t("landing.faq.items.{$i}.q"),
                'answer' => $this->t("landing.faq.items.{$i}.a"),
                'sort_order' => $i,
                'is_published' => true,
            ]);
        }
    }

    /**
     * @return array{en: string, ar: string}
     */
    protected function t(string $key): array
    {
        return [
            'en' => (string) __(''.$key, [], 'en'),
            'ar' => (string) __(''.$key, [], 'ar'),
        ];
    }
}
