<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('id', 'DESC')->paginate(50);
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::all();
        return view('menus.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        Menu::create($request->validated());
        return redirect()->route('menus.index')->with('success', 'Menu đã được thêm thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());
        return redirect()->route('menus.index')
            ->with('success', 'Menu đã cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->menuItems()->delete();
        $menu->delete();
        return redirect()->route('menus.index');
    }

    public function settingMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menuItems = $menu->menuItems()->where('parent', 0)->with('children')->get();
        $category_post = Category::select('id', 'cate_title', 'cate_parent', 'cate_slug')->where('cate_type', 1)->get()->toArray();
        $category_product = Category::select('id', 'cate_title', 'cate_parent', 'cate_slug')->where('cate_type', 2)->get()->toArray();
        $products = Product::all();
        $posts = Post::orderBy('id', 'DESC')->get();
        $postList = $posts->pluck('post_title', 'id')->toArray();
        $pages = Page::all();

        $items = [];

        foreach ($menuItems as $menuItem) {
            $item = $this->buildMenuItem($menuItem);
            $items[] = $item;
        }

        return view('menus.setting', compact('category_post', 'category_product', 'products', 'posts', 'menu', 'pages', 'items', 'postList'));
    }

    private function buildMenuItem($menuItem)
    {
        $item = [
            'id' => $menuItem->id,
            'name' => $menuItem->name,
            'icon' => $menuItem->icon,
            'item_id' => $menuItem->item_id,
            'slug' => $menuItem->slug,
            'type' => $menuItem->type,
            'new' => 1,
            'deleted' => 0,
        ];

        if ($menuItem->children->isNotEmpty()) {
            $item['children'] = [];

            foreach ($menuItem->children as $child) {
                $childItem = $this->buildMenuItem($child);
                $item['children'][] = $childItem;
            }
        }

        return $item;
    }

    public function processMenu(Request $request)
    {
        $menuItems = json_decode($request->input('data'), true);
        // dd($menuItems);
        $menuId = $request->input('menu_id');

        $menuItemsExist = !empty($menuItems);

        MenuItem::where('menu_id', $menuId)->delete();

        if ($menuItemsExist) {
            $this->saveMenuItems($menuItems, 0, $menuId);
        }

        $message = $menuItemsExist ? 'Thiết lập menu thành công.' : 'Không có menu item để lưu.';

        return redirect()->route('menus.index')->with('success', $message);
    }

    private function saveMenuItems($menuItems, $parentId = 0, $menuId = null)
    {
        foreach ($menuItems as $menuItem) {
            $itemChildren = $menuItem['children'] ?? null;
            unset($menuItem['children']);

            $item = MenuItem::updateOrCreate(
                [
                    'menu_id' => $menuId,
                    'item_id' => $menuItem['itemId'],
                    'name' => $menuItem['name'],
                    'icon' => $menuItem['icon'] ?? '',
                    'slug' => $menuItem['slug'],
                    'type' => $this->getItemType($menuItem['slug']),
                    'parent' => $parentId
                ],
                $menuItem
            );
            // dd($item);
            if ($itemChildren) {
                $this->saveMenuItems($itemChildren, $item->id, $menuId);
            }
        }
    }
    public function getItemType($slug): ?string
    {
        $item = null;

        if (Category::where('cate_slug', $slug)->exists()) {
            $item = new Category();
        } else if (Post::where('post_slug', $slug)->exists()) {
            $item = new Post();
        } else if (Product::where('prod_slug', $slug)->exists()) {
            $item = new Product();
        } else if (Page::where('page_slug', $slug)->exists()) {
            $item = new Page();
        }

        return $item?->getTable() ?? 'default';
    }
}
