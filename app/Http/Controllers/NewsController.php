<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::active()
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = NewsCategory::active()->ordered()->get();

        return view('news.index', compact('news', 'categories'));
    }

    /**
     * Display a listing of the resource by category.
     *
     * @param  \App\Models\NewsCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function byCategory(NewsCategory $category)
    {
        $news = $category->news()
            ->active()
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = NewsCategory::active()->ordered()->get();

        return view('news.category', compact('category', 'news', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $news = News::active()->findOrFail($id);

        // Increment view count
        $news->increment('view_count');

        $relatedNews = News::active()
            ->where('id', '!=', $news->id)
            ->whereHas('categories', function ($query) use ($news) {
                $query->whereIn('news_categories.id', $news->categories->pluck('id'));
            })
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
