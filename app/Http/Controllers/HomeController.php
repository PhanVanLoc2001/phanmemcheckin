<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_post = Post::count();
        $posts = Post::with('user')->orderBy('id', 'desc')->take(5)->get();
        $count_product = Product::count();
        $count_user = User::count();
        $contacts = Contact::orderBy('id', 'DESC')->limit(5)->get();
        return view('home', compact('count_post', 'count_product', 'count_user', 'posts','contacts'));
    }

}
