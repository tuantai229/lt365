<?php
namespace App\View\Components;

use Illuminate\View\Component;

class SEOTags extends Component
{
    public array $seoData;

    public function __construct(array $seoData = [])
    {
        $this->seoData = $seoData;
    }

    public function render()
    {
        return view('components.seo-tags');
    }
}
