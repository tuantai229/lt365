<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $page = $request->get('page', 1);

        // Perform search
        $results = $this->searchService->search($query, $page);

        $data = compact('results', 'query');
        $additionalData = [
            'query' => $query,
            'total_results' => $results->total(),
        ];
        $data = array_merge($data, $additionalData);

        return $this->viewWithSeo('search.index', 'search', $data);
    }
}
