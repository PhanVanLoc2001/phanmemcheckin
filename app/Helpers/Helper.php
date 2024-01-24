<?php

use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Str;

function showCategories(
    $categories,
    $select = null,
    $parent_id = 0,
    $char = ''
) {

    foreach ($categories as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['cate_parent'] == $parent_id) {
            $selected = ($item['id'] == $select) ? 'selected' : '';
            echo '<option value="' . $item['id'] . '" ' . $selected . '>';
            echo $char . $item['cate_title'];
            echo '</option>';
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $select, $item['id'], $char . '--');
        }
    }
}


function showCategoriesindex($sub, $select = null, $parent_id = 0)
{
    foreach ($sub as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['cate_parent'] == $parent_id) {
            $checked = in_array($item['id'], $select) ? 'checked' : '';
            echo '<div class="form-check fw-bold pt-2 ">';
            echo '<input class="form-check-input" type="checkbox" data-slug="' . $item['cate_slug'] . '" value="' . $item['id'] . '" data-table="categories"
                                           id="defaultCheck' . $item['id'] . '" name="post_category[]" ' . $checked . '>';
            echo '<label for="defaultCheck' . $item['id'] . '" class="form-check-label" value="' . $item['id'] . '">';
            echo $item['cate_title'];
            echo '</label>';

            // Xóa chuyên mục đã lặp
            unset($sub[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategoriesindex($sub, $select, $item['id']);
            echo '</div>';
        }
    }
}


function showCategoriesproduct($sub, $select = null, $parent_id = 0)
{
    foreach ($sub as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        // dd($item);
        if ($item['cate_parent'] == $parent_id) {
            $checked = in_array($item['id'], $select) ? 'checked' : '';
            echo '<div class="form-check fw-bold pt-2 ">';
            echo '<input class="form-check-input" type="checkbox" data-slug="' . $item['cate_slug'] . '" value="' . $item['id'] . '" data-table="categories"
            id="defaultCheck' . $item['id'] . '" name="product_category[]" ' . $checked . '>';
            echo '<label for="defaultCheck' . $item['id'] . '" class="form-check-label" value="' . $item['id'] . '">';
            echo $item['cate_title'];
            echo '</label>';

            // Xóa chuyên mục đã lặp
            unset($sub[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategoriesproduct($sub, $select, $item['id']);
            echo '</div>';
        }
    }
}

function showMenuItems($menuItems, $parent = 0)
{
    foreach ($menuItems as $key => $menuItem) {
        // Nếu là menu item con của $parent_id thì hiển thị

        if ($menuItem['parent'] == $parent) {
            $hasChildren_ = false;
            $id = $menuItem['id'];
            foreach ($menuItems as $key_ => $menuItem_) {
                if ($menuItem_['parent'] == $menuItem['id']) {
                    $hasChildren_ = true;
                    break;
                }
            }
            echo '<li' . (($menuItem['slug'] == "san-pham" && $hasChildren_) ? ' class="has-submenu megamenu" ' : ($hasChildren_ ? ' class="has-submenu"' : '')) . '>';

            echo '<a href="' . url($menuItem['slug']) . '" >' . $menuItem['name'];
            if ($hasChildren_) {
                echo ' <i class="fas fa-chevron-down"></i>';
            }
            echo '</a>';
            if ($menuItem['slug'] == "san-pham") {
                $menuItems = MenuItem::with('products')->get();
                // dd($menuItems);
                if ($hasChildren_) {
                    echo '<ul class="submenu mega-submenu">';
                    echo '<li>';
                    echo '<div class="megamenu-wrapper">
                    <div class="row">';
                    foreach ($menuItems as $key__ => $menuItem__) {
                        if ($menuItem__['parent'] == $menuItem['id']) {
                            echo '
                            <div class="col-lg-2">
                                <div class="single-demo ">
                                    <div class="demo-img" style="width:80%">
                                    <a class="text-center" href="' . url('san-pham/' . $menuItem__['slug']) . '"><img src="' .  (isset($menuItem__->products->prod_library) ? url($menuItem__->products->prod_library) : url('assets/img/default.jpg'))  . '" class="img-fluid" alt="img"></a>
                                    </div>
                                    <div class="demo-info">
                                        <a href="' . url('san-pham/' . $menuItem__['slug']) . '">' . Str::limit($menuItem__['name'], 30) .
                                '</a>
                                        </div>
                                </div>
                            </div>';
                        }
                    }
                    echo '    </div>
                    </div></li>';

                    echo '</ul>';
                }
            } else {
                if ($hasChildren_) {
                    echo '<ul class="submenu">';
                    unset($menuItems[$key]);
                    showMenuItems($menuItems, $id);
                    echo '</ul>';
                }
            }

            echo '</li>';
        }
    }
}
function showFooterItems($menuItems)
{
    foreach ($menuItems as $menuItem) {
        echo '<li><a href="' . url($menuItem->slug) . '">' . $menuItem . '</a></li>';
    }
}
function renderMenuItem($item)
{
    // dd($item);
    echo '<li class="dd-item" data-id="' . $item['id'] . '" data-icon="' . $item['icon'] . '" data-item-id="' . $item['item_id'] . '"  data-slug="' . $item['slug'] . '" data-name="' . $item['name'] . '" data-table="' . $item['type'] . '" data-new="' . $item['new'] . '" data-deleted="' . $item['deleted'] . '">';
    echo '<div class="dd-handle">' . $item['name'] . '</div>';
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" style="padding:0;" data-owner-id="' . $item['id'] . '" data-owner-table="' . $item['type'] . '"><i class="bx bx-x" aria-hidden="true"></i></span>';
    echo '<span class="button-edit btn btn-success btn-xs pull-right" type="button" data-bs-toggle="modal" data-bs-target="#modalCenter" style="padding:0;" data-owner-id="' . $item['id'] . '" data-owner-name="' . $item['name'] . '" data-owner-item-id="' . $item['item_id'] . '" data-owner-table="' . $item['type'] . '"><i class="bx bxs-pencil" aria-hidden="true"></i></span>';

    if (isset($item['children'])) {
        echo '<ol class="dd-list">';
        foreach ($item['children'] as $child) {
            renderMenuItem($child);
        }
        echo '</ol>';
    }

    echo '</li>';
}
