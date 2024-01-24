<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

const TEMPLATE_NAME = 'frontend';
class CategoryController extends Controller
{
    const PER_PAGE = 50;

    public function index()
    {
        $categories = Category::where('cate_type', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(self::PER_PAGE);
        return view('categories.index', compact('categories'));
    }
    public function getCategoryThemes($category)
    {
        $templates = File::glob(base_path('/resources/views/' . TEMPLATE_NAME . '/' . $category . 'Cate-*.blade.php'));
        return array_map(function ($file) use ($category) {
            $filename = pathinfo($file)['filename'];
            return str_replace([$category . 'Cate-', '.blade'], ['', ''], $filename);
        }, $templates);
    }
    public function show()
    {
        $listCategory = Category::where('cate_type', 2)
            ->orderBy('created_at', 'DESC')
            ->paginate(self::PER_PAGE);
        return view('categories.show', compact('listCategory'));
    }
    public function create(Request $request)
    {
        $cate_type = $request->input('cate_type');
        $arrayTheme = $this->getCategoryThemes('product') ?: $this->getCategoryThemes('post');
        $categories = Category::select('id', 'cate_title', 'cate_parent')->where('cate_type', $cate_type)->get()->toArray();
        return view('categories.create', compact('categories', 'cate_type', 'arrayTheme'));
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        $category->save();
        session()->flash('success', 'Category đã tạo thành công!');
        if (($request->input('cate_type') == "2")) {
            return redirect()->route('categories-show');
        } else {
            return redirect()->route('categories.index');
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $arrayTheme = $this->getCategoryThemes('product') ?: $this->getCategoryThemes('post');
        $cateParent = Category::select('id', 'cate_title', 'cate_parent')->where('cate_type', $category->cate_type)->with('subCate')->get()->toArray();
        return view('categories.edit', compact('cateParent', 'category', 'arrayTheme'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        session()->flash('success', 'Category đã cập nhật thành công!');
        if (($category->cate_type) == "2") {
            return redirect()->route('categories-show');
        } else {
            return redirect()->route('categories.index');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        if (($category->cate_type) == "2") {
            return redirect()->route('categories-show');
        } else {
            return redirect()->route('categories.index');
        }
    }
}
