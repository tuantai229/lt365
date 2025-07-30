<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Response;

class RssController extends Controller
{
    /**
     * Generate the main RSS feed.
     *
     * @return Response
     */
    public function index(): Response
    {
        $news = News::active()->latest()->limit(20)->get();

        return response()
            ->view('rss.index', compact('news'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Generate the RSS feed for a specific category.
     *
     * @param NewsCategory $category
     * @return Response
     */
    public function category(NewsCategory $category): Response
    {
        $news = $category->news()->active()->latest()->limit(20)->get();

        return response()
            ->view('rss.category', compact('news', 'category'))
            ->header('Content-Type', 'application/xml');
    }
}
