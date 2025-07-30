<title>{{ $seoData['meta_title'] ?? 'LT365' }}</title>
<meta name="description" content="{{ $seoData['meta_description'] ?? '' }}">
@if(!empty($seoData['meta_keywords']))
<meta name="keywords" content="{{ $seoData['meta_keywords'] }}">
@endif
<meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index,follow' }}">

<link rel="canonical" href="{{ $seoData['canonical_url'] ?? request()->url() }}">

<meta property="og:title" content="{{ $seoData['meta_title'] ?? 'LT365' }}">
<meta property="og:description" content="{{ $seoData['meta_description'] ?? '' }}">
<meta property="og:type" content="{{ $seoData['og_type'] ?? 'website' }}">
<meta property="og:url" content="{{ $seoData['canonical_url'] ?? request()->url() }}">
<meta property="og:locale" content="{{ $seoData['og_locale'] ?? 'vi_VN' }}">
<meta property="og:site_name" content="LT365">
@if(!empty($seoData['og_image']))
<meta property="og:image" content="{{ $seoData['og_image'] }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['meta_title'] ?? 'LT365' }}">
<meta name="twitter:description" content="{{ $seoData['meta_description'] ?? '' }}">
@if(!empty($seoData['og_image']))
<meta name="twitter:image" content="{{ $seoData['og_image'] }}">
@endif
