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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'slug'        => 'required|unique:pages,slug|alpha_dash|between:3,255',
            'link_target' => 'boolean|nullable',
            'template'    => 'required|string|alpha_dash',
            'icon'        => 'nullable|string|between:3,250',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $page           = new Page;
        $page->slug     = $request->slug;
        $page->template = $request->template;
        $page->icon     = $request->icon;
        $page->save();

        return redirect(route('admin.pages.edit', ['page' => $page]));
    }

    /**
     *  Store translation of page in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Page                $page
     */
    public function storeTranslation(Request $request, Page $page)
    {
        $translation = new PageTranslation;
        $translation->title = $request->title;
        $translation->lang = $request->lang;
        $translation->body = $request->body;
        $translation->keywords = $request->keywords;

        $page->translations()->save($translation);
        return $page;
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
        $templates = Page::templates();
        $page->load('translations');
        foreach ($page->translations as $translation) {
            $translations[ $translation->lang ] = $translation;
        }

        return view('backend.page.form', compact('templates', 'page', 'translations'));
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
     * @param \Illuminate\Http\Request $request
     * @param \App\PageTranslation     $translation
     */
    public function updateTranslation(Request $request, PageTranslation $translation)
    {

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
