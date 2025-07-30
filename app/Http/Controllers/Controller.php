<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\SEOService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    protected SEOService $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
        
        View::share('general_settings', Setting::getGeneralSettings());
        View::share('main_navigation', Setting::getMainNavigation());
        View::share('footer_category_links', Setting::getFooterCategoryLinks());
        View::share('footer_support_links', Setting::getFooterSupportLinks());
    }

    protected function viewWithSeo(string $view, string $routeName, array $data = [], Model $model = null): \Illuminate\View\View
    {
        $seoData = $this->seoService->generateSeoData($routeName, $model, $data);
        
        return view($view, array_merge($data, [
            'seoData' => $seoData,
            'model' => $model,
        ]));
    }
}
