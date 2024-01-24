<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

const TEMPLATE_NAME = 'frontend';
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $pages = Page::orderBy('id', 'DESC')->paginate(50);
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getPageThemes()
    {
        $templates = File::glob(base_path('/resources/views/' . TEMPLATE_NAME . '/page-*.blade.php'));
        return array_map(function ($file) {
            $filename = pathinfo($file)['filename'];
            return str_replace(['page-', '.blade'], ['', ''], $filename);
        }, $templates);
    }
    public function create()
    {
        $arrayTheme = $this->getPageThemes();
        return view('pages.create', compact('arrayTheme'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $page = Page::create($request->validated());
        $page->save();
        return redirect()->route('pages.index')->with('success', 'Trang đã tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $arrayTheme = $this->getPageThemes();
        return view('pages.edit', compact('page', 'arrayTheme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePageRequest $request, Page $page)
    {
        $page->update($request->validated());
        return redirect()->route('pages.index')
            ->with('success', 'Page đã cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')
            ->with('success', 'Trang đã được xóa thành công.');
    }
}
