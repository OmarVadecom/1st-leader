<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;

class HomeController extends Controller
{
    private $_view = 'admin.home.';
    public function index()
    {
        $pages = Page::take(10)->get()->sortByDesc('updated_at');
        return view($this->_view . 'index', compact('pages'));
    }
}
