<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Models\ContactInformation;
use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        try {
            if (Schema::hasTable('contact_information')) {
                $contact = ContactInformation::find(1);
                if ($contact) {
                    View::share('contact', $contact);
                } else {
                    // Xử lý khi không tìm thấy bản ghi với id = 1
                    // Ví dụ: Gán giá trị mặc định cho biến $contact
                    $contact = null;
                    View::share('contact', $contact);
                }
            }

            if (Schema::hasTable('menus')) {
                $menus = Menu::orderBy('position')->get();
                View::share('menus', $menus);
            }
        } catch (QueryException $e) {
            // Xử lý khi không tìm thấy bảng hoặc lỗi truy vấn
            // Ví dụ: Gán giá trị mặc định cho biến $menus và $contact
            $menus = [];
            $contact = null;

            View::share('menus', $menus);
            View::share('contact', $contact);
        }
    }
}
