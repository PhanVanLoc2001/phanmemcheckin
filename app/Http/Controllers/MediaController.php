<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    public function index()
    {
//        $posts = DB::table('nz_posts')->where('post_type', 'post')->get();
//
//        foreach ($posts as $post) {
//            $featured_image_url = ''; // Thêm biến để lưu trữ link ảnh
//
//            // Lấy link ảnh từ dữ liệu đã truy vấn
//            $featured_image = DB::table('nz_postmeta')
//                ->where('nz_postmeta.post_id', $post->ID)
//                ->where('nz_postmeta.meta_key', '_thumbnail_id')
//                ->leftJoin('nz_postmeta AS pm2', 'nz_postmeta.meta_value', '=', 'pm2.post_id')
//                ->where('pm2.meta_key', '_wp_attached_file')
//                ->select('pm2.meta_value AS featured_image_url')
//                ->first();
//
//            if ($featured_image) {
//                $featured_image_url = $featured_image->featured_image_url;
//            }
//
//            // Tạo bài viết trong Laravel và thêm thông tin về link ảnh
//            $newPost = Post::create([
//                'post_title' => $post->post_title,
//                'post_seotitle' => $post->post_title,
//                'post_desc' => $post->post_excerpt,
//                'post_seodesc' => $post->post_excerpt,
//                'post_content' => $post->post_content,
//                'user_id' => 4,
//                'post_status' => 1,
//                'post_spinned' => 0,
//                'post_slug' => $post->post_name,
//                'post_templates' => 'postSingle',
//                'created_at' => $post->post_date,
//                'updated_at' => $post->post_modified,
//                'post_thumb' => $featured_image_url // Thêm thông tin về link ảnh
//            ]);
//
//            // Thực hiện các thao tác khác nếu cần
//        }

        return view('media.index');
    }
}
