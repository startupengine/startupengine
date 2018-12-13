<?php

namespace App\Http\Controllers;

use App\PostType;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function menu() {
        $response = [
            "1" => ["icon" => "view_module", "text" => "Dashboard", "url" => "/admin/dashboard"],
            "2" => ["icon" => "library_books", "text" => "Pages", "url" => "/admin/pages"],
            "3" => ["icon" => "notes", "text" => "Content", "url" => "/admin/content"],
            "4" => ["icon" => "shopping_basket", "text" => "Products", "url" => "/admin/products"],
            "5" => ["icon" => "bar_chart", "text" => "Analytics", "url" => "/admin/analytics"],
            "6" => ["icon" => "people", "text" => "Users", "url" => "/admin/users"],
            "7" => ["icon" => "settings", "text" => "Settings", "url" => "/admin/settings"]

        ];
        return response()
            ->json($response);
    }

    public function notifications() {
        $response = [
            "items" =>
            ["1" => ["category" => "Analytics", "text" => "This is a demo notification", "url" => "/admin/analytics"]],
            "count" => 1
        ];
        return response()
            ->json($response);
    }

    public function user() {
        $response = ["userName" => "John Doe"];
        return response()
            ->json($response);
    }

    public function dashboardAnalytics() {
        $response = [
            "clickCount" => 1423,
            "contentViewCount" => 9921,
            "pageViewCount" => 664,
            "userCount" => 253,
            "subscriberCount" => 1453
        ];
        return response()
            ->json($response);
    }

    public function dashboardSocialFeed() {
        $response = [

                "1" => ["name" => "Daishi Ishihara", "message" => "Well, the way they make shows is, they make one show ...", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "url" => null],
                "2" => ["name" => "Kate O'Connor", "message" => "After the avalanche, it took us a week to climb out. Now...", "image"=> "https://images.unsplash.com/photo-1534607287018-541c7d97748f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f8492e948d2ac5c91199a2623b1c42af&auto=format&fit=crop&w=800&q=60", "url" => null],

        ];
        return response()
            ->json($response);
    }

    public function dashboardRecentContent () {
        $response = [

            "1" => ["id" => 33, "title" => "The State of Business Automation in 2018", "name" => "James Johnson", "message" => "Well, the way they make shows is, they make one show ...", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "url" => null],
            "2" => ["id" => 72, "title" => "Open-Source Startup Dashboard", "name" => "Sara Oren", "message" => "After the avalanche, it took us a week to climb out. Now...", "image"=> "https://images.unsplash.com/photo-1534607287018-541c7d97748f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f8492e948d2ac5c91199a2623b1c42af&auto=format&fit=crop&w=800&q=60", "url" => null],
            "3" => ["id" => 93,"title" => "Content Strategy for Startups", "name" => "Jennifer Michaels", "message" => "After the avalanche, it took us a week to climb out. Now...", "image"=> "https://images.unsplash.com/photo-1534607287018-541c7d97748f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f8492e948d2ac5c91199a2623b1c42af&auto=format&fit=crop&w=800&q=60", "url" => null],

        ];
        return response()
            ->json($response);
    }


    public function pages (Request $request) {
        $page = $request->input('page');
        $response = [
            "data"=> [
                "1" => ["id" => 1, "title" => "Landing","description" => "Basic landing page", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "url" => "/"],
                "2" => ["id" => 1, "title" => "Account","description" => "User profile & payment method/history", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "url" => "/"],
                "3" => ["id" => 1, "title" => "Pricing","description" => "Pricing plans & signup forms", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "url" => "/"],
                "4" => ["id" => 2, "title" => "Articles",  "description" => "Basic blog", "image"=> "https://images.unsplash.com/photo-1534607287018-541c7d97748f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f8492e948d2ac5c91199a2623b1c42af&auto=format&fit=crop&w=800&q=60", "url" => "/features"],
                "5" => ["id" => 2, "title" => "Help",  "description" => "Help center", "image"=> "https://images.unsplash.com/photo-1534607287018-541c7d97748f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f8492e948d2ac5c91199a2623b1c42af&auto=format&fit=crop&w=800&q=60", "url" => "/features"],
            ],
            "current_page" => 1,
            "from" => 1,
            "to" => 20,
            "per_page" => 5,
            "last_page" => 4,
            "path" => "http://127.0.0.1:8000/api/demo/pages",
            "first_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=1",
            "last_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=4",
            "next_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=2",
            "prev_page_url" => null,
            "total" => 20,
            "pages" => 1
        ];
        return response()
            ->json($response);
    }

    public function products (Request $request) {
        $page = $request->input('page');
        $response = [
            "data"=> [
                "1" => ["id" => 1, "title" => "Startup Engine","description" => "CMS Only", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "plan" => "basic", "price" => "25.00", "period" => "monthly"],
                "2" => ["id" => 1, "title" => "Startup Engine","description" => "CMS + CRM", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "plan" => "advanced", "price" => "99.99", "period" => "monthly"],
                "3" => ["id" => 1, "title" => "Startup Engine","description" => "CMS + CRM + Custom Code", "image"=> "https://images.unsplash.com/photo-1520271348391-049dd132bb7c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e5bc9b3a7c6af8a6f5eff9f9a214dae1&auto=format&fit=crop&w=800&q=60", "plan" => "enterprise", "price" => "999.99", "period" => "monthly"]
            ],
            "current_page" => 1,
            "from" => 1,
            "to" => 1,
            "per_page" => 5,
            "last_page" => 1,
            "path" => "http://127.0.0.1:8000/api/demo/pages",
            "first_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=1",
            "last_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=4",
            "next_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=2",
            "prev_page_url" => null,
            "total" => 3
        ];
        return response()
            ->json($response);
    }

    public function users (Request $request) {
        $page = $request->input('page');
        $response = [
            "data"=> [
                "1" => ["id" => 1, "title" => "Kate O'Connor","email" => "kate@example.com", "image"=> "https://images.unsplash.com/photo-1528914457842-1af67b57139d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=6ec93922b8cc28dcc1946fde53179225&auto=format&fit=crop&w=800&q=60", "member_since" => "3 Months Ago", "last_active" => "17 Minutes Ago"]
            ],
            "current_page" => 1,
            "from" => 1,
            "to" => 1,
            "per_page" => 5,
            "last_page" => 1,
            "path" => "http://127.0.0.1:8000/api/demo/pages",
            "first_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=1",
            "last_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=4",
            "next_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=2",
            "prev_page_url" => null,
            "total" => 1,
            "pages" => 1
        ];
        return response()
            ->json($response);
    }

    public function userActivities (Request $request) {
        $page = $request->input('page');
        $response = [
            "data"=> [
                "1" => ["id" => 1, "type" => "like", "email" => "kate@example.com", "object_type" => "post", "object_name" => "The State of Business Automation in 2018", "object_id" => "16", "description" => "Liked a post"],
                "2" => ["id" => 1, "type" => "view", "email" => "kate@example.com", "object_type" => "post", "object_name" => "The State of Business Automation in 2018", "object_id" => "16", "description" => "Read a post"]
            ],
            "current_page" => 1,
            "from" => 1,
            "to" => 1,
            "per_page" => 5,
            "last_page" => 1,
            "path" => "http://127.0.0.1:8000/api/demo/user/1/activities",
            "first_page_url" => "http://127.0.0.1:8000/api/demo/user/1/activities?page%5Bnumber%5D=1",
            "last_page_url" => "http://127.0.0.1:8000/api/demo/user/1/activities?page%5Bnumber%5D=4",
            "next_page_url" => "http://127.0.0.1:8000/api/demo/user/1/activities?page%5Bnumber%5D=2",
            "prev_page_url" => null,
            "total" => 2,
            "pages" => 1
        ];
        return response()
            ->json($response);
    }

    public function contentModels (Request $request) {

        $models = PostType::all();
        $response = [
            "data"=> json_decode($models->toJson()),
            "current_page" => 1,
            "from" => 1,
            "to" => 1,
            "per_page" => 5,
            "last_page" => 1,
            "path" => "http://127.0.0.1:8000/api/demo/pages",
            "first_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=1",
            "last_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=1",
            "next_page_url" => "http://127.0.0.1:8000/api/demo/pages?page%5Bnumber%5D=1",
            "prev_page_url" => null,
            "total" => 20,
            "pages" => 1
        ];
        return response()
            ->json($response);
    }
}
