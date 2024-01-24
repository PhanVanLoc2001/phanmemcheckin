<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

const TEMPLATE_NAME = 'frontend';
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(50);
        return view('products.index', compact('products'));
    }
    public function getProductThemes(): array
    {
        $templates = File::glob(base_path('/resources/views/' . TEMPLATE_NAME . '/productSingle-*.blade.php'));
        return array_map(function ($file) {
            $filename = pathinfo($file)['filename'];
            return str_replace(['productSingle-', '.blade'], ['', ''], $filename);
        }, $templates);
    }
    public function create()
    {
        $subP = Category::select('id', 'cate_title', 'cate_parent', 'cate_slug')->where('cate_type', 2)->get()->toArray();
        $tags = Tag::all();
        $arrayTheme = $this->getProductThemes();
        return view('products.create', [
            'tags' => $tags,
            'subP' => $subP,
            'arrayTheme' => $arrayTheme
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $products = Product::create($request->validated());
        //Trả về người dùng đang tạo bài viết
        $products->user()->associate(Auth::user());
        //Chọn danh mục cho bài viết
        $category_id = $request->input('product_category');
        if (!empty($category_id)) {
            $products->categories()->attach($category_id);
        }
        //Ảnh đại diện
        if ($request->has('prod_thumb')) {
            $products->prod_thumb = $request->input('prod_thumb');
        }
        //Ảnh chi tiết sản phẩm
        if ($request->has('prod_background')) {
            $products->prod_background = $request->input('prod_background');
        }
        if ($request->has('prod_library')) {
            $products->prod_library = $request->input('prod_library');
        }
        $banners = $request->input('prod_feature');
        if ($banners) {
            $products->prod_feature = json_encode($banners);
        }
        //        Phần atributes
        $attributes = $request->input('prod_attributes');
        if ($attributes) {
            $products->prod_attributes = json_encode($attributes);
        }
        //Tags của sản phẩm
        $tags = $request->input('tags');
        if ($tags) {
            foreach ($tags as $tagName) {
                $tagSlug = Str::slug($tagName);
                $tag = Tag::firstOrCreate(['tag_name' => $tagName], ['tag_slug' => $tagSlug]);
                $products->tags()->attach($tag->id);
            }
        }
        //        Lưu lại
        $products->save();
        return redirect()->route('products.index')->with('success', 'Sản phẩm được thêm thành công!');
    }

    public function edit($id)
    {
        //Truy vấn các bảng
        $products = Product::where('id', $id)->with('tags')->first();
        $categories = Category::all();
        $tags = Tag::all();
        $subP = Category::select('id', 'cate_title', 'cate_parent', 'cate_slug')->where('cate_type', 2)->get()->toArray();
        $checkedCategories = [];
        foreach ($products->categories as $category) {
            $checkedCategories[] = $category->id;
        }
        $tag_ids_list = [];
        foreach ($products->tags as $tag) {
            $tag_ids_list[] = $tag->id;
        }
        $arrayTheme = $this->getProductThemes();
        //Phần chuyển đổ json
        // dd(json_decode($products->prod_feature, true));
        $prodAttributes = json_decode($products->prod_attributes, true);
        $result = $this->combineArray($prodAttributes);
        $prodFeature = json_decode($products->prod_feature, true);
        //        dd($result);
        return view('products.edit', compact('products', 'categories', 'tags', 'subP', 'checkedCategories', 'tag_ids_list', 'prodFeature', 'prodAttributes', 'result', 'arrayTheme'));
    }

    protected function combineArray($arr): array
    {
        $result = array();

        if (is_array($arr)) {
            for ($i = 0; $i < count($arr); $i += 2) {
                $subArray = array($arr[$i], $arr[$i + 1]);
                $result[] = $subArray;
            }
        }

        return $result;
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->only([
            'prod_name', 'prod_slug', 'prod_desc', 'prod_content', 'prod_seotitle', 'prod_seodesc',
            'user_id', 'prod_thumb', 'prod_library', 'prod_template', 'prod_status', 'prod_spin',
            'prod_price', 'prod_saleprice', 'prod_attributes', 'prod_feature', 'prod_background',
            'download', 'prod_excerpt', 'update'
        ]));
        $product->prod_spin = $request->has('prod_spin') ? 1 : 0;
        //phần ảnh
        if ($request->has('prod_thumb')) {
            $product->prod_thumb = $request->input('prod_thumb');
        }
        if ($request->has('prod_library')) {
            $product->prod_library = $request->input('prod_library');
        }
        if ($request->has('updated_at')) {
            $product->updated_at = $request->input('updated_at');
        }
        if ($request->has('prod_library')) {
            $product->prod_library = $request->input('prod_library');
        }
        if ($request->has('prod_background')) {
            $product->prod_background = $request->input('prod_background');
        }
        // Cập nhật liên kết danh mục
        $category_id = $request->input('product_category', []);
        if (!empty($category_id)) {
            $product->categories()->sync($category_id);
        } else {
            $product->categories()->detach();
        }
        // Cập nhật liên kết tag
        $tags = $request->input('tags', []);
        $tagIds = [];
        if ($tags) {
            foreach ($tags as $tag) {
                $tagModel = Tag::find($tag);
                if ($tagModel) {
                    $tagIds[] = $tagModel->id;
                } else {
                    $tagSlug = Str::slug($tag);
                    $newTag = Tag::create(['tag_name' => $tag, 'tag_slug' => $tagSlug]);
                    if ($newTag) {
                        $tagIds[] = $newTag->id;
                    }
                }
            }
        }
        //Lưu nội dung bằng json
        $banners = $request->input('prod_feature');
        if ($banners) {
            $product->prod_feature = json_encode($banners);
        }
        //        Phần atributes
        $attributes = $request->input('prod_attributes');
        if ($attributes) {
            $product->prod_attributes = json_encode($attributes);
        }

        $product->prodTag()->sync($tagIds);
        session()->flash('success', 'Sản phẩm đã cập nhật thành công!');
        $product->save();
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();
        $product->prodTag()->detach();
        $product->delete();
        return redirect()->route('products.index');
    }
}
