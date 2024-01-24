<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Recruitment;
use App\Models\Tag;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class HandleController extends Controller
{

    public function index()
    {
        $tools = $this->spinPost(1);
        $posts_all = $this->latestNews(6, 'Tin Tức');
        $newspaper = $this->newspaper(4, 'bao-chi');

        // Kiểm tra xem có bài viết nào được ghim không
        if ($tools->isEmpty()) {
            $tools = collect([$posts_all->first()]);
        }

        return view('frontend.index', compact('tools', 'posts_all', 'newspaper'));
    }

    public function first($slugFirst)
    {
        $page = $this->getPageBySlug($slugFirst);
        if ($page) {
            return $this->handlePage($page);
        }
        $category = $this->getCategoryBySlug($slugFirst);
        if ($category) {
            return $this->handleCategory($category);
        }
        $post = $this->getPostBySlug($slugFirst);
        if ($post) {
            return $this->handlePost($post);
        }
        abort(404);
    }

    public function latestNews($limit, $category)
    {
        return Post::whereHas('categories', function ($query) use ($category) {
            $query->where('cate_title', $category);
        })->orderBy('id', 'DESC')->limit($limit)->get();
    }
    public function newspaper($limit, $category)
    {
        return Post::whereHas('categories', function ($query) use ($category) {
            $query->where('cate_slug', $category);
        })->orderBy('id', 'DESC')->limit($limit)->get();
    }

    public function spinProduct($limit)
    {
        return Product::orderBy('id', 'DESC')->where([
            'prod_status' => 1, 'prod_spin' => 1
        ])->limit($limit)->get();
    }

    public function spinPost($limit)
    {
        return Post::orderBy('id', 'DESC')->where([
            'post_status' => 1, 'post_spinned' => 1
        ])->limit($limit)->get();
    }
    public function product($slug)
    {
        $product = $this->getProductBySlug($slug);
        if ($product) {
            return $this->handleProduct($product);
        }
        abort(404);
    }
    private function handlePost($post)
    {
        $template = $post->post_templates;
        $category = $post->categories->first();
        if ($category->cate_slug == "bao-chi") {
            return redirect('/');
        }
        $categories = Category::all();
        $tags = $post->tags;
        $relatedPosts = $this->getRelatedPosts($post->tags->pluck('tag_name')->toArray());
        $postIds = explode(',', $post->post_list);
        $postList = Post::whereIn('id', $postIds)->get();
        $category_slug = 'tin-tuc'; // Đặt giá trị của danh mục cố định

        $randomPosts = Post::whereHas('categories', function ($query) use ($category_slug) {
            $query->where('cate_slug', $category_slug);
        })->inRandomOrder()->take(4)->get();
        $news = $this->latestNews(4, 'Tin Tức');
        $view = $template == "postSingle" ? 'frontend.' . $template : 'frontend.postSingle-' . $template;
        return view($view, compact('post', 'category', 'tags',  'postList', 'relatedPosts', 'news', 'categories', 'randomPosts'));
    }
    function getRelatedPosts($tag)
    {
        // Lấy 4 bài viết gần nhất có cùng tags
        $relatedPosts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->whereNotNull('tag_name')->where('tag_name', $tag);
        })
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $count = $relatedPosts->count();

        // Kiểm tra số bài viết liên quan
        if ($count < 4) {
            // Lấy số bài viết ngẫu nhiên để điền vào
            $randomPosts = Post::whereNotIn('id', $relatedPosts->pluck('id')->toArray())
                ->inRandomOrder()
                ->take(4 - $count)
                ->get();

            // Kết hợp các bài viết ngẫu nhiên với bài viết liên quan
            $relatedPosts = $relatedPosts->concat($randomPosts);
        }

        return $relatedPosts;
    }
    public function handleTag($tag)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tag_slug', $tag);
        })->paginate(10);
        $tags = Tag::where('tag_slug', $tag)->first();
        $latestNews = $this->latestNews(5, 'Tin tức');
        $products = $this->spinProduct(5);
        return view('frontend.tag', compact('tag', 'posts', 'latestNews', 'products', 'tags'));
    }

    private function getCategoryBySlug($slug)
    {
        return Category::where('cate_slug', $slug)->first();
    }

    private function getPageBySlug($slug)
    {
        return Page::where('page_slug', $slug)->first();
    }

    private function getProductBySlug($slug)
    {
        return Product::where('prod_slug', $slug)->first();
    }

    private function getPostBySlug($slug)
    {
        return Post::where('post_slug', $slug)->first();
    }

    private function getFilteredPostsByCategory($category, $table)
    {
        return $table::with('categories')
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('cate_title', $category->cate_title);
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
    private function handleCategory($category)
    {
        $news = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('cate_title', $category->cate_title);
        })->orderBy('created_at', 'DESC')->paginate(9);
        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('cate_title', $category->cate_title);
        })->orderBy('created_at', 'DESC')->paginate(12);
        $prodList = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('cate_title', $category->cate_title);
        })->orderBy('created_at', 'DESC')->paginate(10);
        $productCate = $this->getFilteredPostsByCategory($category, Product::class);
        $template = $category->cate_template;
        $view = $category->cate_type == '2'
            ? ($template == "productCate" ? 'frontend.' . $template : 'frontend.productCate-' . $template)
            : ($template == "postCate" ? 'frontend.' . $template : 'frontend.postCate-' . $template);

        return view($view, compact('news', 'category', 'productCate', 'prodList', 'products'));
    }

    private function handlePage($page)
    {
        $products = Product::orderBy('updated_at', 'DESC')->where('prod_status', 1)->get();
        $recruitments = Recruitment::orderBy('id', 'DESC')->where('rec_status', 1)->get();
        $template = $page->page_templates;
        $view = $template == "page" ? 'frontend.' . $template : 'frontend.page-' . $template;
        return view($view, compact('products', 'page', 'recruitments'));
    }

    private function handleProduct($product)
    {
        $template = $product->prod_template;
        $category = $product->categories->first();
        $categories = Category::all();
        $tags = $product->tags;
        $prodRelated = $this->spinProduct(4);
        $category_slug = 'san-pham';
        $randomPosts = Product::whereHas('categories', function ($query) use ($category_slug) {
            $query->where('cate_slug', $category_slug);
        })->inRandomOrder()->take(4)->get();
        $news = $this->latestNews(4, 'Tin Tức');
        $prodFeature = json_decode($product->prod_feature, true);
        $prodAttributes = json_decode($product->prod_attributes, true);
        $result = $this->combineArray($prodAttributes);
        $view = $template == "productSingle" ? 'frontend.' . $template : 'frontend.productSingle-' . $template;
        return view($view, compact('product', 'prodFeature', 'result', 'prodRelated', 'category', 'categories', 'tags', 'news', 'randomPosts'));
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
    public function sitemap()
    {
        $sitemap = Sitemap::create();

        $sitemap->add(
            Url::create('/')
                ->setPriority(1)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS)
        );

        $categories = Category::whereIn('cate_slug', ['tin-tuc', 'san-pham'])->get();

        foreach ($categories as $category) {
            $sitemap->add(
                Url::create($category->cate_slug)
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.6)
            );
        }

        foreach (Post::where('post_status', 1)->where(function ($query) {
            $query->whereDoesntHave('categories', function ($query) {
                $query->where('cate_slug', 'bao-chi');
            })->orWhereDoesntHave('categories');
        })->get() as $post) {
            $sitemap->add(
                Url::create($post->post_slug)
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8)
            );
        }

        foreach (Product::where('prod_status', 1)->get() as $prod) {
            $sitemap->add(
                Url::create(url('san-pham/' . $prod->prod_slug))
                    ->setLastModificationDate($prod->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8)
            );
        }
        foreach (Tag::all() as $tag) {
            $sitemap->add(
                Url::create(url('tag/' . $tag->tag_slug))
                    ->setLastModificationDate($prod->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8)
            );
            // dd($sitemap);
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
