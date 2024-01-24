<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
