<?php

namespace App\Services;

use App\Enums\LandingItemType;
use App\Models\LandingFaq;
use App\Models\LandingItem;
use App\Models\LandingPlan;
use App\Models\LandingSetting;
use App\Models\LandingTestimonial;
use App\Support\ContentLocale;
use Illuminate\Support\Collection;

class LandingContentService
{
    /**
     * @return array{
     *     settings: LandingSetting,
     *     features: Collection<int, LandingItem>,
     *     steps: Collection<int, LandingItem>,
     *     benefits: Collection<int, LandingItem>,
     *     useCases: Collection<int, LandingItem>,
     *     testimonials: Collection<int, LandingTestimonial>,
     *     plans: Collection<int, LandingPlan>,
     *     faqs: Collection<int, LandingFaq>
     * }
     */
    public function forPublicPage(): array
    {
        ContentLocale::setForRequest(app()->getLocale());

        return [
            'settings' => LandingSetting::current(),
            'features' => $this->publishedItems(LandingItemType::Feature),
            'steps' => $this->publishedItems(LandingItemType::Step),
            'benefits' => $this->publishedItems(LandingItemType::Benefit),
            'useCases' => $this->publishedItems(LandingItemType::UseCase),
            'testimonials' => LandingTestimonial::query()
                ->published()
                ->ordered()
                ->with('media')
                ->get(),
            'plans' => LandingPlan::query()
                ->published()
                ->ordered()
                ->get(),
            'faqs' => LandingFaq::query()
                ->published()
                ->ordered()
                ->get(),
        ];
    }

    /**
     * @return Collection<int, LandingItem>
     */
    protected function publishedItems(LandingItemType $type): Collection
    {
        return LandingItem::query()
            ->ofType($type)
            ->published()
            ->ordered()
            ->get();
    }
}
