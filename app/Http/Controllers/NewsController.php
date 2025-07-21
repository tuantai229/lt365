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
        // Logic to fetch all news will be added later
        return view('news.index');
    }

    /**
     * Display a listing of the resource by category.
     *
     * @param  \App\Models\NewsCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function byCategory(NewsCategory $category)
    {
        // Logic to fetch news by category will be added later
        return view('news.category', compact('category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        // Logic to fetch a single news item will be added later
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }
}
