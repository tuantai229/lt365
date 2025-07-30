<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\News;
use App\Models\Document;
use App\Models\School;
use App\Models\Center;
use App\Models\Teacher;

class SitemapController extends Controller
{
    /**
     * Generate the main sitemap index file.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('sitemap.index');
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $view->render();

        return response($content)->header('Content-Type', 'text/xml');
    }

    /**
     * Generate the sitemap for a specific content type.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        $items = $this->getItemsFor($type);

        if (is_null($items)) {
            abort(404);
        }

        $view = view('sitemap.show', [
            'items' => $items,
            'type' => $type
        ]);
        
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $view->render();

        return response($content)->header('Content-Type', 'text/xml');
    }

    /**
     * Get items for a specific sitemap type.
     *
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    protected function getItemsFor($type)
    {
        switch ($type) {
            case 'pages':
                return Page::where('status', 1)->get();
            case 'news':
                return News::where('status', 1)->latest()->get();
            case 'documents':
                return Document::where('status', 1)->latest()->get();
            case 'schools':
                return School::where('status', 1)->latest()->get();
            case 'centers':
                return Center::where('status', 1)->latest()->get();
            case 'teachers':
                return Teacher::where('status', 1)->latest()->get();
            default:
                return null;
        }
    }
}
