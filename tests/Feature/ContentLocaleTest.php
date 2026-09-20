<?php

use App\Models\Experience;
use App\Support\ContentLocale;

test('cv fields store locales independently without overwriting', function () {
    ContentLocale::set('en');

    $experience = new Experience;
    $experience->title = 'Sales Manager';
    $experience->company = 'ABC Company';

    ContentLocale::set('ar');
    $experience->title = 'مدير مبيعات';

    expect($experience->getTranslation('title', 'en', false))->toBe('Sales Manager')
        ->and($experience->getTranslation('title', 'ar', false))->toBe('مدير مبيعات')
        ->and($experience->getTranslation('company', 'en', false))->toBe('ABC Company')
        ->and($experience->getTranslation('company', 'ar', false))->toBeNull();
});

test('portfolio falls back to the other language per field', function () {
    $experience = new Experience;
    $experience->setTranslation('title', 'en', 'Only English Title');
    $experience->setTranslation('description', 'ar', 'وصف عربي فقط');

    expect($experience->getTranslation('title', 'ar', true))->toBe('Only English Title')
        ->and($experience->getTranslation('description', 'en', true))->toBe('وصف عربي فقط')
        ->and($experience->getTranslation('title', 'ar', false))->toBeNull();
});

test('content locale switch route updates session', function () {
    $response = $this->from('/client/dashboard')->get(route('content-locale.switch', 'ar'));

    $response->assertRedirect('/client/dashboard');
    expect(session('content_locale'))->toBe('ar');
});
