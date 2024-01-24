<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

const TEMPLATE_NAME = 'frontend';
class PostController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(50);
        $search = $request->input('search');
        $post_search = Post::query()
            ->where('post_title', 'LIKE', "%$search%")
            ->orderBy('created_at', 'DESC')
            ->paginate(50);
        // dd($post_search);
        return view('posts.index', compact('posts', 'post_search'));
    }
    public function create()
    {
        $sub = Category::select('id', 'cate_title', 'cate_parent', 'cate_slug')->where('cate_type', 1)->get()->toArray();
        $tags = Tag::all();
        $posts = Post::orderBy('created_at', 'desc')->get();
        $postList = $posts->pluck('post_title', 'id')->toArray();
        $arrayTheme = $this->getPostThemes();
        return view('posts.create', [
            'tags' => $tags,
            'sub' => $sub,
            'arrayTheme' => $arrayTheme,
            'postList' => $postList
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function getPostThemes(): array
    {
        $templates = File::glob(base_path('/resources/views/' . TEMPLATE_NAME . '/single-*.blade.php'));
        return array_map(function ($file) {
            $filename = pathinfo($file)['filename'];
            return str_replace(['single-', '.blade'], ['', ''], $filename);
        }, $templates);
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        //iu dơ ở đây
        $post->user()->associate(Auth::user());
        //ảnh đại diện
        if ($request->has('post_thumb')) {
            $post->post_thumb = $request->input('post_thumb');
        }
        $postList = $request->input('post_list');
        if ($postList) {
            $post->post_list = implode(',', $postList);
        }
        //danh mục
        $category_id = $request->input('post_category');
        if (!empty($category_id)) {
            $post->categories()->attach($category_id);
        }
        //thư viện
        $post_library = $request->input('post_library');
        $post->post_library = implode(',', (array)$post_library);
        //Tags
        $tags = $request->input('tags');


        if ($tags) {
            foreach ($tags as $tagName) {
                $tagSlug = Str::slug($tagName);

                $tag = Tag::firstOrCreate(['tag_name' => $tagName], ['tag_slug' => $tagSlug]);
                $post->tags()->attach($tag->id);
            }
        }
        $saved = $post->save();

        return redirect()->route('posts.index')->with('success', 'Bài viết đã tạo thành công!');
    }
    public function edit($id)
    {
        $posts = Post::where('id', $id)->with('tags')->first();
        $image_paths = explode(',', $posts->post_library);
        $arrayTheme = $this->getPostThemes();
        $categories = Category::all();
        $tags = Tag::all();
        $postList = Post::where('id', '!=', $id)->pluck('post_title', 'id')->all();
        $selectedPosts = [];
        if ($postList) {
            $selectedPosts = explode(',', $posts->post_list ?? '');
        }
        $sub = Category::select('id', 'cate_title', 'cate_parent', 'cate_slug')->where('cate_type', 1)->get()->toArray();
        $selectedCategories = [];
        foreach ($posts->categories as $category) {
            $selectedCategories[] = $category->id;
        }
        $tag_ids_coroi = [];
        foreach ($posts->tags as $tag) {
            $tag_ids_coroi[] = $tag->id;
        }
        return view('posts.edit', compact('posts', 'categories', 'selectedCategories', 'tags', 'sub', 'tag_ids_coroi', 'image_paths', 'arrayTheme', 'postList', 'selectedPosts'));
    }
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->only([
            'post_title', 'post_slug', 'post_content', 'post_seotitle', 'post_desc',
            'post_seodesc', 'post_keyword', 'post_status', 'post_thumb', 'post_spinned', 'post_list'
        ]));
        $post->post_spinned = $request->has('post_spinned') ? 1 : 0;
        if ($request->has('post_thumb')) {
            $post->post_thumb = $request->input('post_thumb');
        }
        if ($request->has('updated_at')) {
            $post->updated_at = $request->input('updated_at');
        }
        $category_id = $request->input('post_category', []);
        if (!empty($category_id)) {
            $post->categories()->sync($category_id);
        } else {
            $post->categories()->detach();
        }
        $postList = $request->input('post_list');
        if ($postList) {
            $postListString = implode(',', $postList);
            $post->post_list = $postListString;
        }
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
        $post->postTag()->sync($tagIds);
        session()->flash('success', 'Bài viết đã cập nhật thành công!');
        $post->save();
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->categories()->detach();
        $post->postTag()->detach();
        $post->delete();
        return redirect()->route('posts.index');
    }
}
