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

function showMenuItems($menuItems, $parent = 0): void
{
    foreach ($menuItems as $menuItem) {
        // dd($menuItem);
        // Nếu là menu item con của $parent_id thì hiển thị
        if ($menuItem->parent == $parent) {
            $hasChildren = false; // Khai báo biến $hasChildren
            foreach ($menuItems as $childItem) {
                if ($childItem->parent == $menuItem->id) {
                    $hasChildren = true;
                    break;
                }
            }

            echo '<li' . ($hasChildren ? ' class="has-children"' : '') . '>';
            echo '<a href="' . url($menuItem->slug) . '">' . $menuItem->name;
            echo '</a>';
            if ($hasChildren) {
                echo '<ul class="dropdown">';
                showMenuItems($menuItems, $menuItem->id);
                echo '</ul>';
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
