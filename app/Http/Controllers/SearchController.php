<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $results = Post::where('post_title', 'like', '%' . strtolower($keyword) . '%')
            ->orderBy('created_at', 'desc')
            ->with(['categories' => function ($query) {
                $query->select('cate_slug');
            }])
            ->paginate(10);
        $products = $this->spinProduct(5);
        $latestNews = $this->latestNews(5, 'Tin tức');

        $highlightedResults = $results->map(function ($result) use ($keyword) {
            $title = $result->post_title;
            $content = $result->post_content;

            $highlightedTitle = preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<span class="highlight">$1</span>', $title);
            $highlightedContent = preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<span class="highlight">$1</span>', $content);
            $result->post_title = $highlightedTitle;
            $result->post_content = $highlightedContent;

            return $result;
        });

        $links = $results->appends(['q' => $keyword])->onEachSide(2)->links();
        return view('search.results', [
            'results' => $highlightedResults,
            'keyword' => $keyword,
            'latestNews' => $latestNews,
            'products' => $products,
            'links' => $links
        ]);
    }
    public function latestNews($limit, $category)
    {
        return Post::whereHas('categories', function ($query) use ($category) {
            $query->where('cate_title', $category);
        })->orderBy('id', 'DESC')->limit($limit)->get();
    }

    public function spinProduct($limit)
    {
        return Product::orderBy('id', 'DESC')->where([
            'prod_status' => 1, 'prod_spin' => 1
        ])->limit($limit)->get();
    }
}
