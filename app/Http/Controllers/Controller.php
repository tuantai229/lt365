<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    public function __construct()
    {
        View::share('general_settings', Setting::getGeneralSettings());
        View::share('main_navigation', Setting::getMainNavigation());
        View::share('footer_category_links', Setting::getFooterCategoryLinks());
        View::share('footer_support_links', Setting::getFooterSupportLinks());
    }
}
