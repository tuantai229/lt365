<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        // Ensure the page is active before showing
        if (!$page->status) {
            abort(404);
        }

        return $this->viewWithSeo('pages.show', 'page.show', compact('page'), $page);
    }
}
