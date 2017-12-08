<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\PageTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('translations')->get();
        return view('backend.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        $templates = Page::templates();
//        dd($templates);
        return view('backend.page.form', compact('page', 'templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required|unique:pages,slug|alpha_dash|between:3,255',
            'link_target' => 'boolean|nullable',
            'template' => 'required|string|alpha_dash',
            'icon' => 'nullable|string|between:3,250',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        return $request;
    }

    /**
     *  Store translation of page in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Page                $page
     */
    public function storeTranslation(Request $request, Page $page)
    {
        $translation = new PageTranslation();
        $page->translations()->save($translation);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Page $page
     *
     * @return void
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Page $page
     *
     * @return void
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Page                 $page
     *
     * @return void
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Page $page
     *
     * @return void
     */
    public function destroy(Page $page)
    {
        //
    }
}
