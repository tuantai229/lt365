<?php

if (!function_exists('get_image_url')) {
    /**
     * Get the full URL for an image, prepending the admin domain if necessary.
     *
     * @param string|null $path
     * @return string
     */
    function get_image_url(?string $path): string
    {
        if (empty($path)) {
            return asset('images/no-image.png'); // Or a default placeholder
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $adminDomain = rtrim(config('domains.admin'), '/');
        
        return $adminDomain . '/' . ltrim($path, '/');
    }
}
