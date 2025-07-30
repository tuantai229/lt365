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
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug, $id)
    {
        $news = News::with('metaSeo')->active()->findOrFail($id);

        // Increment view count with session-based throttling
        $viewedPosts = $request->session()->get('viewed_posts', []);
        $viewDelay = 3 * 60; // 3 minutes in seconds

        if (!isset($viewedPosts[$news->id]) || (time() - $viewedPosts[$news->id]) > $viewDelay) {
            $news->increment('view_count');
            $viewedPosts[$news->id] = time();
            $request->session()->put('viewed_posts', $viewedPosts);
        }

        $relatedNews = News::active()
            ->where('id', '!=', $news->id)
            ->whereHas('categories', function ($query) use ($news) {
                $query->whereIn('news_categories.id', $news->categories->pluck('id'));
            })
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $data = compact('news', 'relatedNews');

        return $this->viewWithSeo('news.show', 'news.show', $data, $news);
    }
}
